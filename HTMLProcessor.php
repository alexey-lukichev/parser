<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function getHTMLFromURL(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        return $html;
    }

    function parseImagesFromHTML(string $html): array
    {
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $tags = $doc->getElementsByTagName('img');
        $images = [];
        foreach ($tags as $tag)
        {
            $images[] = $tag->getAttribute('src');
        }
        return $images;
    }

    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        $html = getHTMLFromURL($url);
        $images = parseImagesFromHTML($html);

        if (!empty($images)) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($images);
        } else {
            http_response_code(404);
        }
    }
}
