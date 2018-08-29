<?php

namespace LoveLetter\Service;

class CSVReader {

    public function __construct() {
        
    }

    public function read($csvFile) {

        $file_handle = fopen($csvFile, 'r');

        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024, ";");
        }
        fclose($file_handle);


        $headers = $line_of_text[0];
        $organizedDatas = [];


        for ($i = 0; $i < sizeOf($line_of_text); $i++) {

            if ($i != 0) {
                $organizedData = [];
                foreach ($headers as $key => $header) {
                    $organizedData[$header] = $line_of_text[$i][$key];
                }
                $organizedDatas[] = $organizedData;
            }
        }


        return $organizedDatas;
    }

}
