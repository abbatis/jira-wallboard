<?php

namespace App\Http\Controllers;

use Atlassian\JiraRest\Requests\Issue\IssueRequest;
use Atlassian\JiraRest\Requests\Project\ProjectRequest;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    /**
     * @var string
     */
    private $project = "GAZELLEB2C";

    /**
     * @var array
     */
    private $issueStatusMap = [
        "ToDo" => [
            "New",
            "Unresolved"
        ],
        "Done" => [
            "Resolved",
            "Finished"
        ],
        "UAT" => [
            ".*UAT.*"
        ],
        "Test" => [
            ".*Test.*"
        ],
        "Code Review" => [
            ".*Review.*"
        ]
    ];

    /**
     * @return $this
     * @throws \Atlassian\JiraRest\Exceptions\JiraClientException
     * @throws \Atlassian\JiraRest\Exceptions\JiraNotFoundException
     * @throws \Atlassian\JiraRest\Exceptions\JiraUnauthorizedException
     * @throws \TypeError
     */
    public function index () {
        $projectRequest = new ProjectRequest();
        $issueRequest = new IssueRequest();

        $projectCollection = $projectRequest->all();
        $firstProject = reset($projectCollection);

        $issueCollection = json_decode($issueRequest->search([
            "jql" => "project=".$this->project ?: $firstProject['id'].' AND sprint="20" AND resolution=Unresolved'
        ])->getBody(), true)['issues'];

        $jiraCollection = [
            "projectCollection" => [],
            "issueCollection"   => $this->transformIssues($issueCollection)
        ];

        return view('vue.app')
            ->with('jiraCollection', json_encode($jiraCollection));
    }

    /**
     * @param array $issueCollection
     * @param array $result
     *
     * @return array
     */
    private function transformIssues(array $issueCollection, $result = [])
    {
        foreach ($issueCollection as $issueKey => $issueValue) {
            $fields = $issueValue['fields'];
            $newField = [
                "name"      => $fields['summary'],
                "status"    => $this->transformStatus($fields['status']['name']),
                "id"        => $issueValue['id'],
                "key"       => $issueValue['key'],
                "assignee"  => $fields['assignee'],
                "subTasks"  => $fields['subtasks'],
                "reporter"  => $fields['reporter']
            ];

            if (empty($newField['subTasks'])) $newField['subTasks'][] = $newField;

            $result[] = $newField;
        }
        return $result;
    }

    /**
     * @param string $status
     *
     * @return int|string
     */
    private function transformStatus (string $status)
    {
        foreach ($this->issueStatusMap as $mapKey => $mapValue) {
            if (in_array($status, $mapValue)) return $mapKey;
            foreach ($mapValue as $mapValueValue) {
                if (preg_match('/'.$mapValueValue.'/i', $status)) return $mapKey;
            }
        }
        return $status;
    }
}
