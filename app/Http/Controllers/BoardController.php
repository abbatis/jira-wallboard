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
            "Unresolved",
            ".*ToDo.*",
            "To Do"
        ],
        "Done" => [
            "Resolved",
            "Finished",
            "Closed"
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

        if (is_array($projectCollection)) {
            $firstProject = reset($projectCollection);
        }

        $issueCollection = json_decode($issueRequest->search([
            "jql" => "project=".$this->project ?: $firstProject['id'].' AND sprint="20"',
            "maxResults" => 200
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
            if (isSet($issueValue['fields']['parent'])) {
                $subtask = $issueValue;
                $parent = $issueValue['fields']['parent'];
                if (!isSet($result[$parent['id']])) {
                    $result[$parent['id']] = $this->beautifyIssue($parent);
                }
                $result[$parent['id']]['subTasks'][] = $this->beautifyIssue($subtask);
            } else {
                $result[$issueValue['id']] = $this->beautifyIssue($issueValue);
                $result[$issueValue['id']]['subTasks'] = [$this->beautifyIssue($issueValue)];
            }
        }
        return $result;
    }

    /**
     * @param $issueValue
     *
     * @return array
     */
    private function beautifyIssue($issueValue)
    {
        $fields = $issueValue['fields'];
        return [
            "name"      => $fields['summary'],
            "status"    => $this->transformStatus($fields['status']['name']),
            "id"        => $issueValue['id'],
            "key"       => $issueValue['key'],
            "assignee"  => $fields['assignee'] ?? "None",
            "subTasks"  => $fields['subtasks'] ?? [],
            "reporter"  => $fields['reporter'] ?? []
        ];
    }

    /**
     * @param string $status
     *
     * @return int|string
     */
    private function transformStatus (string $status)
    {
        foreach ($this->issueStatusMap as $mapKey => $mapValue) {
            if (preg_grep('/'.$status.'/i', $mapValue)
                || strtolower($status) == strtolower($mapKey)) return $mapKey;
            foreach ($mapValue as $mapValueValue) {
                if (preg_match('/'.$mapValueValue.'/i', $status)) return $mapKey;
            }
        }
        return $status;
    }
}
