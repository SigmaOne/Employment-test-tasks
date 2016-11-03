<?php
// Script to load my server a bit with requests

for ($i = 0; $i < 60;) {
    file_get_contents("http://localhost:8000/products");
    sleep(1);
    $i++;

    file_get_contents("http://localhost:8000/getAdditionalProducts?sortBy=id&from=" . (($i % 3)*10) . "&to=" . ((($i % 3) + 1)*10));
    sleep(1);
    $i++;

    file_get_contents("http://localhost:8000/getAdditionalProducts?sortBy=id&from=" . ((($i % 3) + 1)*10) . "&to=" . ((($i % 3) + 2)*10));
    sleep(1);
    $i++;

    file_get_contents("http://localhost:8000/getAdditionalProducts?sortBy=id&from=" . ((($i % 3) + 2)*10) . "&to=" . ((($i % 3) + 3)*10));
    sleep(1);
    $i++;

    file_get_contents("http://localhost:8000/getAdditionalProducts?sortBy=id&from=" . ((($i % 3) + 2)*10) . "&to=" . ((($i % 3) + 4)*10));
    sleep(1);
    $i++;
}
