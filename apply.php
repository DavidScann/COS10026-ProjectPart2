<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'header.inc';
    ?>
</head>

<body>
    <div class="container">
        <h1>Apply for a Position</h1>
        <p class="intro-text">Ready to join our team? Fill out the form below to apply for one of our current openings. We look forward to learning more about you and your skills.</p>

        <?php
        // Check if job reference was passed in URL
        $jobRef = isset($_GET['job']) ? htmlspecialchars($_GET['job']) : "";
        ?>

        <form id="application-form" action="process_eoi.php" method="post" class="application-form">
            <div class="form-section">
                <h2>Position Information</h2>
                
                <div class="form-group">
                    <label for="jobref">Job Reference Number:</label>
                    <input type="text" id="jobref" name="jobref" value="<?php echo $jobRef; ?>" pattern="[A-Za-z0-9]{5}" maxlength="5" required>
                    <span class="form-hint">Exactly 5 alphanumeric characters (e.g., WS42X)</span>
                </div>
            </div>

            <div class="form-section">
                <h2>Personal Information</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" pattern="[A-Za-z]{1,20}" maxlength="20" required>
                        <span class="form-hint">Maximum 20 letters</span>
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" pattern="[A-Za-z]{1,20}" maxlength="20" required>
                        <span class="form-hint">Maximum 20 letters</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="text" id="dob" name="dob" pattern="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" required>
                    <span class="form-hint">Format: dd/mm/yyyy</span>
                </div>
                
                <fieldset class="form-group">
                    <legend>Gender:</legend>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="male" name="gender" value="male" required>
                            <label for="male">Male</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="nonbinary" name="gender" value="nonbinary">
                            <label for="nonbinary">Non-binary</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="prefernottosay" name="gender" value="prefernottosay">
                            <label for="prefernottosay">Prefer not to say</label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="form-section">
                <h2>Contact Information</h2>
                
                <div class="form-group">
                    <label for="address">Street Address:</label>
                    <input type="text" id="address" name="address" maxlength="40" required>
                    <span class="form-hint">Maximum 40 characters</span>
                </div>
                
                <div class="form-group">
                    <label for="suburb">Suburb/Town:</label>
                    <input type="text" id="suburb" name="suburb" maxlength="40" required>
                    <span class="form-hint">Maximum 40 characters</span>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="state">State:</label>
                        <select id="state" name="state" required>
                            <option value="" disabled selected>Select state</option>
                            <option value="VIC">VIC</option>
                            <option value="NSW">NSW</option>
                            <option value="QLD">QLD</option>
                            <option value="NT">NT</option>
                            <option value="WA">WA</option>
                            <option value="SA">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="ACT">ACT</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}" maxlength="4" required>
                        <span class="form-hint">Exactly 4 digits</span>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" required>
                        <span class="form-hint">Valid email format required</span>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9 ]{8,12}" required>
                        <span class="form-hint">8-12 digits or spaces</span>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Skills & Experience</h2>
                
                <fieldset class="form-group skills-group">
                    <legend>Select your skills:</legend>
                    <div class="checkbox-grid">
                        <div class="checkbox-option">
                            <input type="checkbox" id="html" name="skills[]" value="html">
                            <label for="html">HTML/CSS</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="javascript" name="skills[]" value="javascript">
                            <label for="javascript">JavaScript</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="php" name="skills[]" value="php">
                            <label for="php">PHP</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="python" name="skills[]" value="python">
                            <label for="python">Python</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="hardware" name="skills[]" value="hardware">
                            <label for="hardware">Hardware Troubleshooting</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="network" name="skills[]" value="network">
                            <label for="network">Network Administration</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="pcb" name="skills[]" value="pcb">
                            <label for="pcb">PCB Design</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="embedded" name="skills[]" value="embedded">
                            <label for="embedded">Embedded Systems</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="iot" name="skills[]" value="iot">
                            <label for="iot">IoT Development</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="server" name="skills[]" value="server">
                            <label for="server">Server Management</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="cloud" name="skills[]" value="cloud">
                            <label for="cloud">Cloud Infrastructure</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="cyber" name="skills[]" value="cyber">
                            <label for="cyber">Cybersecurity</label>
                        </div>
                    </div>
                </fieldset>
                
                <div class="form-group">
                    <label for="otherskills">Other Skills:</label>
                    <textarea id="otherskills" name="otherskills" rows="4"></textarea>
                    <span class="form-hint">Please specify any additional skills not listed above</span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-apply">Apply</button>
                <button type="reset" class="btn-reset">Reset Form</button>
            </div>
        </form>
    </div>

    <?php
    include 'footer.inc';
    ?>

    <script>
        // JavaScript to ensure at least one skill is selected
        document.getElementById('application-form').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[name="skills[]"]');
            let checked = false;
            
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    checked = true;
                }
            });
            
            if (!checked) {
                alert('Please select at least one skill');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>