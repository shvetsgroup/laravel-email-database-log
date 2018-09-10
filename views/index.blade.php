<!DOCTYPE html>
<html>
    <head>
        <title>Emails Log</title>

        <style>
            ul.pagination {
                list-style-type: none;
            }
            ul.pagination li {
                float: left;
                padding: 0 5px;
            }
            strong {
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <h1>List of Emails</h1>

        <ul>
            @foreach($emails as $email)
                <li>
                    {{ $email->date }} - From: {{ $email->from }}, To: {{ $email->to }}, Subject: <strong>{{ $email->subject }}</strong> <a href="{{ route('email-log.show', $email->id) }}">VIEW</a>
                    <ul>
                        @foreach($email->events as $event)
                            <li><strong>{{ $event->event }}</strong> {{ $event->created_at }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>

        {{ $emails->links() }}
    </body>
</html>