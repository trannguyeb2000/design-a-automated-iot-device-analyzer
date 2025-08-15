<?php

class IoT_Device_Analyzer {
    private $device_data;
    private $analyzed_data;

    public function __construct($device_data) {
        $this->device_data = $device_data;
    }

    public function analyze() {
        foreach ($this->device_data as $key => $value) {
            switch ($key) {
                case 'temperature':
                    $this->check_temperature_range($value);
                    break;
                case 'humidity':
                    $this->check_humidity_range($value);
                    break;
                case 'voltage':
                    $this->check_voltage_range($value);
                    break;
                default:
                    echo "Unknown device data: $key\n";
            }
        }
    }

    private function check_temperature_range($temperature) {
        if ($temperature < 0 || $temperature > 100) {
            $this->analyzed_data['temperature'] = "OUT_OF_RANGE";
        } else {
            $this->analyzed_data['temperature'] = "OK";
        }
    }

    private function check_humidity_range($humidity) {
        if ($humidity < 0 || $humidity > 100) {
            $this->analyzed_data['humidity'] = "OUT_OF_RANGE";
        } else {
            $this->analyzed_data['humidity'] = "OK";
        }
    }

    private function check_voltage_range($voltage) {
        if ($voltage < 0 || $voltage > 12) {
            $this->analyzed_data['voltage'] = "OUT_OF_RANGE";
        } else {
            $this->analyzed_data['voltage'] = "OK";
        }
    }

    public function get_analyzed_data() {
        return $this->analyzed_data;
    }
}

// Test case
$device_data = array(
    'temperature' => 50,
    'humidity' => 60,
    'voltage' => 5,
    'unknown' => 'unknown value'
);

$analyzer = new IoT_Device_Analyzer($device_data);
$analyzer->analyze();
$analyzed_data = $analyzer->get_analyzed_data();

print_r($analyzed_data);

?>