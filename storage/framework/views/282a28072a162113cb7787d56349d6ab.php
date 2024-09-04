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
        <form method="post" action="<?php echo e(route('tasks.store')); ?>">
            <?php echo csrf_field(); ?>
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
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="<?php echo e($task->completed_at ? 'completed' : ''); ?>">
                    <a href="<?php echo e(route('tasks.edit', $task->id)); ?>"><?php echo e($task->title); ?></a>
                </td>
                <td class="<?php echo e($task->completed_at ? 'completed' : ''); ?>"><?php echo e($task->description); ?></td>
                <td><?php echo e($task->created_at); ?></td>
                <td>
                    <form method="post" action="<?php echo e(route('tasks.destroy', $task->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <button type="submit">Delete</button>
                    </form>
                    <form method="post" action="<?php echo e(route('tasks.complete', $task->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit">Complete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <?php $__currentLoopData = $completedTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($task->title); ?></td>
                    <td><?php echo e($task->description); ?></td>
                    <td><?php echo e($task->created_at); ?></td>
                    <td><?php echo e($task->completed_at); ?></td>
                    <td>
                        <?php if($task->completed_at && $task->created_at): ?>
                            <?php echo e(\Carbon\Carbon::parse($task->completed_at)->diffForHumans(\Carbon\Carbon::parse($task->created_at))); ?>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php /**PATH /Applications/MAMP/htdocs/tasks/resources/views/tasks/index.blade.php ENDPATH**/ ?>