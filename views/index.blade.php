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
            form {
                margin: .5rem 0;
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
                @if(false)
                    <!-- Commented out as only available in 5.8.13 -->
                    @error('date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                @else
                    @if($errors->has('date'))
                        <span>{{ $errors->first('date') }}</span>
                    @endif
                @endif
                <input type="submit" value="Delete">
            </form>

            <form action="{{ route('email-log') }}" method="GET">
                <p>Filter sent e-mails by:</p>
                <label for="filterEmail"><code>to</code>:</label>
                <input type="text" name="filterEmail" id="filterEmail" value="{{ $filterEmail ?: '' }}">
                @if(false)
                    <!-- Commented out as only available in 5.8.13 -->
                    @error('filterEmail')
                        <div class="error">{{ $message }}</div>
                    @enderror
                @else
                    @if($errors->has('filterEmail'))
                        <span>{{ $errors->first('filterEmail') }}</span>
                    @endif
                @endif
                <br>
                <label for="filterSubject"><code>subject</code>:</label>
                <input type="text" name="filterSubject" id="filterSubject" value="{{ $filterSubject ?: '' }}">
                @if(false)
                    <!-- Commented out as only available in 5.8.13 -->
                    @error('filterSubject')
                        <div class="error">{{ $message }}</div>
                    @enderror
                @else
                    @if($errors->has('filterSubject'))
                        <span>{{ $errors->first('filterSubject') }}</span>
                    @endif
                @endif
                <br><input type="submit" value="Search">
                @if($filterEmail || $filterSubject)
                    <a type="button" href="{{ route('email-log') }}">Clear filters</a>
                @endif
            </form>
        </div>

        @if($emails->count() == 0)
            <div>
                <p>No results.</p>
                @if($filterEmail || $filterSubject)
                    <p>Try <a href="{{ route('email-log') }}">clearing</a> filters.</p>
                @endif
            </div>
        @endif

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