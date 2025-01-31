<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $meta_data['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.css">
    <style>
        /* Custom styles for the flipbook */
        #flipbook {
            width: 800px;
            height: 600px;
            margin: 0 auto;
        }
        .page {
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .page h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .page h4 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .page p {
            font-size: 16px;
            line-height: 1.6;
        }
        .page img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <!-- Flipbook Container -->
    <div id="flipbook">
        @foreach($book->chapters as $chapter)
            <div class="page">
                <h3>{{ $chapter->title }}</h3>
                @foreach($chapter->topics->sortBy('order') as $topic)
                    <div>
                        @if($topic->type === 'title')
                            <h4>{{ $topic->content }}</h4>
                        @elseif($topic->type === 'paragraph')
                            <p>{!! nl2br(e($topic->content)) !!}</p>
                        @elseif($topic->type === 'image')
                            <img src="{{ asset('storage/' . $topic->content) }}" alt="Image">
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <div class="text-center mt-4">
        <button id="prev" class="btn btn-primary">Previous</button>
        <button id="next" class="btn btn-primary">Next</button>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize the flipbook
        $('#flipbook').turn({
            width: 800,
            height: 600,
            autoCenter: true,
            acceleration: true,
            gradients: true,
        });

        // Navigation buttons
        $('#prev').click(function() {
            $('#flipbook').turn('previous');
        });

        $('#next').click(function() {
            $('#flipbook').turn('next');
        });
    });
</script>
</body>
</html>
