<?php

require('ConstructOutput.php');

print($headHTML);
if (isset($_GET['BookIdToSend'])) {
    $bookName = getBookName($_GET['BookIdToSend']);
    printf($headerChapterTable, $bookName);
    listChapters($_GET['BookIdToSend']);
    print($footerChapterTable);
} elseif (isset($_POST['isCreateBook'])) {
    $book = createBook();
    printf($messageBookCreated, $book->getName());
} else {
    print($headerBookTable);
    listBooks();
    print($footerTable);
}
print($footer);
//insertRecordsFromJSON();
