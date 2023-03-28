<?php 
declare(strict_types=1);

namespace Scraper;

class ScraperHTML{


    public static function toHtml(Array $data) : void {
        
        // Sort Data Desc Values;
        arsort($data);

        $rows = self::rowsData($data);

        echo "<table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Host</th>
                            <th>Match Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        $rows
                    </tbody>

                </table>";
    }

    private static function rowsData(Array $data) : String {

        $rows = '';
        $i = 0;

        foreach ($data as $host => $matchResult) {
            $i++;
            $rows .= "<tr>
                        <td>$i</td>
                        <td>$host</td>
                        <td>$matchResult</td>  
                      </tr>";
        }

        return ($rows == '') ? '<tr><td colspan="3" style="text-align:center; padding:25px;">Not Content</td> </tr>' : $rows;
       
    }

}