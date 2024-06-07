<?php

namespace App\Helpers;

class Chart
{
    protected $labels = [];
    protected $datasets = [];
    protected $options = [];

    public function setLabels($labels)
    {
        $this->labels = $labels;
    }

    public function setDataset($label, $data, $backgroundColor, $borderColor)
    {
        $this->datasets[] = [
            'label' => $label,
            'data' => $data,
            'backgroundColor' => $backgroundColor,
            'borderColor' => $borderColor,
        ];
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function render($type, $filename)
    {
        // Here you can use a library like Chart.js to generate the chart image
        // and save it to the specified file path ($filename)
        // You can refer to Chart.js documentation for how to generate charts: https://www.chartjs.org/docs/latest/
    }
}
