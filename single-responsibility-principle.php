<?php
//without single responsibility principle
class Report
{
    public function getTitle()
    {
        return 'Report Title';
    }
    public function getDate()
    {
        return '2016-04-21';
    }
    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate(),
        ];
    }
    public function formatJson()
    {
        return json_encode($this->getContents());
    }
    public function formatHTML()
    {
        list('title'=>$title, 'date' => $date) = $this->getContents();
        return "<h2>$title</h2><p>$date</p>";
    }
}

//without srp
$report = new Report();
//echo $report->formatJson();
echo $report->formatHTML();

// Refactored
class Report
{
    public function getTitle()
    {
        return 'Report Title';
    }
    public function getDate()
    {
        return '2016-04-21';
    }
    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate(),
        ];
    }
}
interface ReportFormattable
{
    public function format(Report $report);
}
class JsonReportFormatter implements ReportFormattable
{
    public function format(Report $report)
    {
        return json_encode($report->getContents());
    }
}



//with srp
$report = new Report();
$json = new JsonReportFormatter();
echo $json->format($report);