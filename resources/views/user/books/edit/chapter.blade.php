<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">
    <link href="{{asset('assets/global/css/editor.css')}}" rel="stylesheet">
    <script src="{{asset('assets/json-preview.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>
<body>
<div class="ce-example">
    <div class="ce-example__content _ce-example__content--small">
        <div id="editorjs"></div>

        <div class="ce-example__button" id="saveButton">
            editor.save()
        </div>

    </div>
    <div class="ce-example__output">
        <pre class="ce-example__output-content" id="output"></pre>

        <div class="ce-example__output-footer">
            <a href="https://codex.so" style="font-weight: bold;">Made by CodeX</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
<script src="https://cdn.jsdelivr.net/npm/editorjs-undo"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-image-editorjs@1.4.0/dist/bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

<!-- Initialization -->
<script>
    var editor = new EditorJS({

        readOnly: false,
        holder: 'editorjs',
        inlineToolbar: true,
        tools: {
            header: {
                class: Header,
                config: {
                    placeholder: 'Enter a header',
                    levels: [1, 2, 3, 4, 5, 6],
                    defaultLevel: 3
                }
            },
            image: SimpleImage
        },

        defaultBlock: 'paragraph',
        data: {
            blocks: [
                {
                    type: "header",
                    data: {
                        text: "Essssssssssss ssssssditor.js",
                        level: 2
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: 'Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration.'
                    }
                },
                {
                    type: "header",
                    data: {
                        text: "Key features",
                        level: 3
                    }
                },
                {
                    type: "header",
                    data: {
                        text: "What does it mean «block-styled editor»",
                        level: 3
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: 'Workspace in classic editors is made of a single contenteditable element, used to create different HTML markups. Editor.js <mark class=\"cdx-marker\">workspace consists of separate Blocks: paragraphs, headings, images, lists, quotes, etc</mark>. Each of them is an independent contenteditable element (or more complex structure) provided by Plugin and united by Editor\'s Core.'
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: `There are dozens of <a href="https://github.com/editor-js">ready-to-use Blocks</a> and the <a href="https://editorjs.io/creating-a-block-tool">simple API</a> for creation any Block you need. For example, you can implement Blocks for Tweets, Instagram posts, surveys and polls, CTA-buttons and even games.`
                    }
                },
                {
                    type: "header",
                    data: {
                        text: "What does it mean clean data output",
                        level: 3
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: 'Classic WYSIWYG-editors produce raw HTML-markup with both content data and content appearance. On the contrary, Editor.js outputs JSON object with data of each Block. You can see an example below'
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: `Given data can be used as you want: render with HTML for <code class="inline-code">Web clients</code>, render natively for <code class="inline-code">mobile apps</code>, create markup for <code class="inline-code">Facebook Instant Articles</code> or <code class="inline-code">Google AMP</code>, generate an <code class="inline-code">audio version</code> and so on.`
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: 'Clean data is useful to sanitize, validate and process on the backend.'
                    }
                },
                {
                    type: 'paragraph',
                    data: {
                        text: 'We have been working on this project more than three years. Several large media projects help us to test and debug the Editor, to make its core more stable. At the same time we significantly improved the API. Now, it can be used to create any plugin for any task. Hope you enjoy. 😏'
                    }
                },
                {
                    type: 'image',
                    data: {
                        url: '/assets/codex2x.png',
                        caption: '',
                        stretched: false,
                        withBorder: true,
                        withBackground: false,
                    }
                },
            ]
        },
        onReady: function () {
            saveButton.click();
            new Undo({editor});
        },
        onChange: function (api, event) {
            console.log('something changed', event);
        }
    });

    const saveButton = document.getElementById('saveButton');

    /**
     * Saving example
     */
    saveButton.addEventListener('click', function () {
        editor.save()
            .then((savedData) => {
                cPreview.show(savedData, document.getElementById("output"));
            })
            .catch((error) => {
                console.error('Saving error', error);
            });
    });
</script>
</body>
</html>
