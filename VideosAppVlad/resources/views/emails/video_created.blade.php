<!-- resources/views/emails/video_created.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>New Video Created</title>
</head>
<body>
<h1>New Video Created</h1>
<p>A new video titled "{{ $videoTitle }}" has been created.</p>
<p>Click the link below to view the video:</p>
<a href="{{ $videoUrl }}">View Video</a>
<p>Thank you for using our application!</p>
</body>
</html>
