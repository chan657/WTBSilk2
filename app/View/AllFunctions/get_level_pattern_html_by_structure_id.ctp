<?php
App::import('Model', 'DigLevel');
App::import('Model', 'DigPattern');
$attr = new DigLevel();
$patternAttr = new DigPattern();
if (count($DataArray) > 0) {
    // pr($DigLevel1);
    ?>

    <table class="table">
        <tr>   
            <th width="10%">Sl. No.</th>
            <th width="10%">Level Information</th>
            <th width="60%">Pattern Information</th>	

        </tr>
        <?php
        // pr($amenities);
        $i = 1;
        if (isset($DataArray) && count($DataArray) > 0):
            foreach ($DataArray['DigStructure'] as $key => $val) :

                //$id = $amenities[$key]['LookupValueAmenitie']['group_id'];
                ?>
                <tr>
                    <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                    <td align="left" valign="right" class="tablebody"><?php if($val) echo $attr->getLevelName($val); ?></td>
                    <td align="left" valign="left" class="tablebody">
                        <?php
                        if ($i == '1') {
                            foreach ($DigLevel1 as $val1) {
                                echo $patternAttr->getPatternName($val1['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val1['level_pattern_8']);
                            }
                        }
                        if ($i == '2') {
                            foreach ($DigLevel2 as $val2) {
                                echo $patternAttr->getPatternName($val2['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val2['level_pattern_8']);
                            }
                        }
                        if ($i == '3') {
                            foreach ($DigLevel3 as $val3) {
                                echo $patternAttr->getPatternName($val3['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val3['level_pattern_8']);
                            }
                        }
                        if ($i == '4') {
                            foreach ($DigLevel4 as $val4) {
                                echo $patternAttr->getPatternName($val4['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val4['level_pattern_8']);
                            }
                        }
                        if ($i == '5') {
                            foreach ($DigLevel5 as $val5) {
                                echo $patternAttr->getPatternName($val5['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val5['level_pattern_8']);
                            }
                        }
                        if ($i == '6') {
                            foreach ($DigLevel6 as $val6) {
                                echo $patternAttr->getPatternName($val6['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val6['level_pattern_8']);
                            }
                        }
                        if ($i == '7') {
                            foreach ($DigLevel7 as $val7) {
                                echo $patternAttr->getPatternName($val7['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val7['level_pattern_8']);
                            }
                        }
                        if ($i == '8') {
                            foreach ($DigLevel8 as $val8) {
                                echo $patternAttr->getPatternName($val8['level_pattern_1']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_2']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_3']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_4']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_5']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_6']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_7']) . ' , ' . $patternAttr->getPatternName($val8['level_pattern_8']);
                            }
                        }
                        ?>
                    </td>
                </tr>

                <?php
                $i++;
            endforeach;
        endif;
        ?>
    </table>                                          


    <?php
}?>