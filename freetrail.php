<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Trial Videos</title>
    
        
    </style>
</head>
<body>
    <h1>Free Trial Videos</h1>
    <div class="video-container">
        <?php
        // PHP script to embed videos
        $videos = [
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://player.vimeo.com/video/76979871',
            // Add more video URLs here
        ];

        foreach ($videos as $video) {
            echo '<div class="video">';
            echo '<iframe width="560" height="315" src="' . $video . '" frameborder="0" allowfullscreen></iframe>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
<?php
// PHP script to embed self-hosted videos
$videos = [
    'videos/video1.mp4',
    'videos/video2.mp4',
    // Add more video file paths here
];

foreach ($videos as $video) {
    echo '<div class="video">';
    echo '<video width="560" height="315" controls>';
    echo '<source src="' . $video . '" type="video/mp4">';
    echo 'Your browser does not support the video tag.';
    echo '</video>';
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Trial Videos</title>
    
</head>
<body>
    <h1>Free Trial Videos</h1>
    <div class="video-container">
        <?php
        // Array of video URLs (external hosting and self-hosted)
        $videos = [
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://player.vimeo.com/video/76979871',
            'videos/video1.mp4',
            'videos/video2.mp4',
        ];

        foreach ($videos as $video) {
            echo '<div class="video">';
            if (strpos($video, 'youtube') !== false || strpos($video, 'vimeo') !== false) {
                // Embed external hosted video
                echo '<iframe src="' . $video . '" frameborder="0" allowfullscreen></iframe>';
            } else {
                // Embed self-hosted video
                echo '<video controls>';
                echo '<source src="' . $video . '" type="video/mp4">';
                echo 'Your browser does not support the video tag.';
                echo '</video>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>