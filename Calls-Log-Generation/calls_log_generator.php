<?php
/**Generates random phone number*/
function randomNumberSequence($requiredLength = 8, $highestDigit = 9)
{
    $sequence = "";
    for ($i = 0; $i < $requiredLength; ++$i) {
        $sequence .= mt_rand(0, $highestDigit);
    }
    return "890" . strval($sequence);
}
/**Generates random date*/
function generateRandomDate($month = 1, $maxday = 30, $year = 2009)
{
    if ($month < 10) {
        $strval = "0" . strval($month);
    } else {
        $strval = strval($month);
    }
    return strval(rand(1, $maxday)) . "-" . $strval . "-" . strval($year);
}

/**Fills Calls Journal witn N records*/
function fillJournal($max_records = 1000)
{
    $db = new PDO(
        "mysql:dbname=calls_table;host=localhost",
        "testadmin",
        "testadmin"
    );
    $db->query("use calls_table");
    $rowCount = $db->query("SELECT COUNT(*) FROM calls")->fetchColumn();
    echo "Rows detected: " . $rowCount . "\n";
    $maxIter = $max_records + $rowCount;
    $currentProgress = 0;
    echo "Progress: 0%" . "\n";
    $start = 1;
    for ($i = $rowCount + 1; $i < $maxIter; $i++) {
        $sql =
            "insert into  calls (id, phone_init, phone_receiver, duration, date) values  (" .
                strval($i) .
                "," .
                '"' .
                strval(randomNumberSequence()) .
                '"' .
                "," .
                '"' .
                strval(randomNumberSequence()) .
                '"' .
                "," .
                '"' .
                strval(random_int(20, 5000)) >
            $db->prepare($sql)->execute();
        $progressUpdated = intdiv($start * 100, $max_records);
        if ($progressUpdated != $currentProgress) {
            $currentProgress = $progressUpdated;
            echo "Progress: " . $currentProgress . "%" . "\n";
        }
        $start = $start + 1;
    }
    echo "Progress: 100%" . "\n";
    echo strval($max_records) . " Lines were added!\n";
}

fillJournal();
