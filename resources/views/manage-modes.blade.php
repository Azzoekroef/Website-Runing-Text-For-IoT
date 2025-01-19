<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Modes</title>
    <link rel="stylesheet" href="<?php echo asset('css/app.css'); ?>">
    <style>
        /* Menambahkan sedikit styling agar tampilan lebih rapi */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }
        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        form input[type="number"],
        form input[type="text"],
        form input[type="checkbox"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form .btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        h2 {
            margin-top: 40px;
            color: #007bff;
        }
        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e6f7ff;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Display Modes</h1>
        <form action="<?php echo url('/api/modes'); ?>" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label>Mode:</label>
            <input type="number" name="mode" required>
            <label>Text:</label>
            <input type="text" name="text">
            <label>Text Top:</label>
            <input type="text" name="text_top">
            <label>Text Bottom:</label>
            <input type="text" name="text_bottom">
            <label>Delay (ms):</label>
            <input type="number" name="delay" required>
            <label>Scroll:</label>
            <input type="checkbox" name="scroll">
            <label>Scroll Top:</label>
            <input type="checkbox" name="scroll_top">
            <label>Scroll Bottom:</label>
            <input type="checkbox" name="scroll_bottom">
            <label>Show Clock:</label>
            <input type="checkbox" name="show_clock">
            <button type="submit" class="btn btn-primary mt-2">Add Mode</button>
        </form>

        <h2 class="mt-5">Existing Modes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mode</th>
                    <th>Text</th>
                    <th>Top Text</th>
                    <th>Bottom Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modes as $mode): ?>
                    <tr>
                        <td><?php echo $mode->id; ?></td>
                        <td><?php echo $mode->mode; ?></td>
                        <td><?php echo $mode->text; ?></td>
                        <td><?php echo $mode->text_top; ?></td>
                        <td><?php echo $mode->text_bottom; ?></td>
                        <td>
                            <form action="<?php echo url('/api/modes/'.$mode->id); ?>" method="POST" style="display:inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="<?php echo asset('js/app.js'); ?>"></script>
</body>
</html>
