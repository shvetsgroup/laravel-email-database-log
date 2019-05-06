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
            .message {
                color: #1e5f1e;
                padding: .25rem;
                border: 1px solid #1e5f1e;
                margin: .25rem;
                text-align: center;
            }
            .error {
                color: #ff3041;
            }
        </style>
    </head>

    <body>
        @if(session('status'))
            <div class="message">{{ session('status') }}</div>
        @endif

        <h1>List of Emails</h1>

        <div class="actions">
            <form action="{{ route('email-log.delete-old') }}" method="POST"
                  onsubmit="return confirm('Are you sure? You will not be able to undo this actions!')">
                {{ csrf_field() }}
                <label for="date">Delete all emails older than this date (excludes the selected date):</label>
                <input type="date" name="date" id="date">
                @error('date')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="submit" value="Delete">
            </form>
        </div>

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