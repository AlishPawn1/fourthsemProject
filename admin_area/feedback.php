<?php

if (isset($_GET['feedback'])) {
    $select_query = "SELECT * FROM contact_message";
    $result = mysqli_query($conn, $select_query);
}

?>

<section class="feedback-section section-gaps">
    <div class="container">
        <table class="table text-center table-bordered">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>name</th>
                    <th>email</th>
                    <th>subject</th>
                    <th>message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($result) && mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$i}</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No feedback available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>