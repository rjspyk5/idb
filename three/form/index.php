<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="form-container  rounded-lg shadow-md shadow-white">
        <h2>Registration Form</h2>
        <form class="space-y-3 space-x-3 *:rounded-lg" method="post" action="">
            <label class="ml-3" for="name">Name:</label>
            <input type="text" name="name" id="name" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>
            <input class="btn btn-sm bg-green-500 text-white" type="submit" name="submit" value="Submit">
        </form>
    </div>
    <div class="data-container">
        <?php
        class FormHandler
        {
            private $formData = [];

            function handleFormSubmission()
            {
                if (isset($_POST['submit'])) {
                    $this->formData = json_decode(file_get_contents('form_data.txt'), true) ?: [];
                    array_push($this->formData, $_POST);
                    file_put_contents('form_data.txt', json_encode($this->formData) . PHP_EOL);
                }
            }
            function displayFormData()
            {
                if (!empty($this->formData)) {
                    echo '<h2>Submitted Form Data:</h2><table ><tr>';
                    // Table header
                    foreach (array_keys($this->formData[0] ?? []) as $header) {
                        if ($header != "submit") {
                            echo '<th>' . htmlspecialchars($header) . '</th>';
                        }
                    }
                    echo '</tr>';
                    // Table data
                    foreach ($this->formData as $submission) {
                        echo '<tr>';
                        foreach ($submission as $value) {
                            if ($value != "Submit") {
                                echo '<td>' . htmlspecialchars($value) . '</td>';
                            }
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                }
            }
        }
        // Create object of form
        $formHandler = new FormHandler();
        // Handle form submission
        $formHandler->handleFormSubmission();
        // Display submitted form data in a table
        $formHandler->displayFormData();
        ?>
    </div>

</body>

</html>