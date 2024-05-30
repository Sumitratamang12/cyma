<?php
            // Example branch data (replace with actual data)
            $branches = array(
                array(
                    'name' => 'Branch 1',
                    'location' => 'City A',
                    'manager' => 'John Doe',
                    'contact' => '123-456-7890'
                ),
                array(
                    'name' => 'Branch 2',
                    'location' => 'City B',
                    'manager' => 'Jane Smith',
                    'contact' => '098-765-4321'
                )
            );

            // Loop through branches and display information
            foreach ($branches as $branch) {
                echo '<div class="branch">';
                echo '<h3>' . $branch['name'] . '</h3>';
                echo '<p>Location: ' . $branch['location'] . '</p>';
                echo '<p>Manager: ' . $branch['manager'] . '</p>';
                echo '<p>Contact: ' . $branch['contact'] . '</p>';
                echo '</div>';
            }
            ?>