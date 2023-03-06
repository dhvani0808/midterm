<?php
			//Database Credentials
			$servername = "AWS";
			$username = "Dhvani200522994";
			$password = "674jwCgCuQ";
			$dbname = "Dhvani200522994";

			// Create a connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
            }

			// Select all services from the database
			$sql = "SELECT id, name FROM services";
			$result = $conn->query($sql);

			// Output each service as an option in the dropdown
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
				}
			}
			foreach($shows as $show) {
                <div class="show-item">
                  <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $show['showId']; ?>)">
                    <?php echo $show['title']; ?>
                  </a>
                  <div class="show-details">
                    <p><?php echo $show['description']; ?></p>
                    <p>Airs on <?php echo $show['airDay']; ?> at <?php echo $show['airTime']; ?></p>
                  </div>
                </div>
            }

            // prepare and execute SQL query to delete show from database
            $sql = "DELETE FROM shows WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $showId);
            $stmt->execute();

			// redirect user back to select-service.php
            header("Location: select-service.php");
            exit();
			
			// Close the connection
			$conn->close();
			?>