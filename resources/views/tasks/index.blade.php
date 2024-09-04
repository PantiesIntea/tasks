<!DOCTYPE html>
<html>
    <head>
        <title>Task List</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            form {
                display: inline-block;
            }

            table {
                width: 100%;
                margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .completed {
            text-decoration: line-through;
        }
    </style>
</head>
<body>
    <div>
        <h1>Task List</h1>
        <form method="post" action="{{ route('tasks.store') }}">
            @csrf
            <label for="title">Title</label>
            <input type="text" id="title" name="title">
            <br>
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
            <br>
            <button type="submit">Add Task</button>
        </form>
    </div>
    <div>
        <h2>Current Tasks</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
            <tr>
                <td class="{{ $task->completed_at ? 'completed' : '' }}">
                    <a href="{{ route('tasks.edit', $task->id) }}">{{ $task->title }}</a>
                </td>
                <td class="{{ $task->completed_at ? 'completed' : '' }}">{{ $task->description }}</td>
                <td>{{ $task->created_at }}</td>
                <td>
                    <form method="post" action="{{ route('tasks.destroy', $task->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit">Delete</button>
                    </form>
                    <form method="post" action="{{ route('tasks.complete', $task->id) }}">
                        @csrf
                        <button type="submit">Complete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
    <h2>Completed Tasks</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Completed At</th>
                <th>Time Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach($completedTasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->completed_at }}</td>
                    <td>
                        @if($task->completed_at && $task->created_at)
                            {{ \Carbon\Carbon::parse($task->completed_at)->diffForHumans(\Carbon\Carbon::parse($task->created_at)) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
