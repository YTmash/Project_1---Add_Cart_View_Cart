
      <form action="contact.php" method="post" novalidate>
        <p>* All fields are required.</p>

        <input type="text" name="fName" id="fName" value="<?php if(isset($_POST['fName'])) echo $_POST['fName']; ?>" placeholder="First Name *" autofocus required class="<?php if(isset($_POST['submit']) && empty($_POST['fName'])) echo 'w3-khaki border-error'; ?>"><br>
        <input type="text" name="lName" id="lName" value="<?php if(isset($_POST['lName'])) echo $_POST['lName']; ?>" placeholder="Last Name *" autofocus required class="<?php if(isset($_POST['submit']) && empty($_POST['lName'])) echo 'w3-khaki border-error'; ?>"><br>
        <input type="email" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email *" autofocus required class="<?php if(isset($_POST['submit']) && empty($_POST['email'])) echo 'w3-khaki border-error'; ?>"><br>
        <input type="text" name="subject" id="subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject']; ?>" placeholder="Subject *" autofocus required class="<?php if(isset($_POST['submit']) && empty($_POST['subject'])) echo 'w3-khaki border-error'; ?>"><br>
        <textarea name="comment" id="comment" rows="10" placeholder="Comment...*" required class="<?php if(isset($_POST['submit']) && empty($_POST['comment'])) echo 'w3-khaki border-error'; ?>"><?php if(isset($_POST['comment'])) echo $_POST['comment']; ?></textarea><br>

        <input type="submit" class="w3-btn w3-teal" name="submit" value="Contact Us"> <input type="reset" value="Clear Form" class="w3-btn w3-khaki w3-margin-left">
      </form>
      
