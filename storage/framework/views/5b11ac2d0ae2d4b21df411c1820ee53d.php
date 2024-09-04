<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            resize: vertical;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0062cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form method="POST" action="<?php echo e(route('tasks.update', $task->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo e($task->title); ?>">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description"><?php echo e($task->description); ?></textarea>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH /Applications/MAMP/htdocs/tasks/resources/views/tasks/edit.blade.php ENDPATH**/ ?>