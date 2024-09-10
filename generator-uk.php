<?php
session_start();

// Change this to your desired password
$correct_password = "R3xEmA1l!";

// Check if user is already authorized
if (!isset($_SESSION["authorized"]) || !$_SESSION["authorized"]) {
    // User is not yet authorized, check if password has been submitted
    if (isset($_POST["password"]) && $_POST["password"] == $correct_password) {
        // Password is correct, set authorized session variable
        $_SESSION["authorized"] = true;
    } else {
        // Password is not correct, show password form
        echo '
        <center>
            <form method="post">
                <label for="password">Password:</label>
                <input type="password" name="password">
                <input type="submit" value="Submit">
            </form>
            </center>
        ';
        // Stop execution so the rest of the page is not displayed
        exit();
    }
}

// If the code reaches this point, the user is authorized and can access the protected content
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
   <head>
      <style>
         .container {
         display: grid;
         grid-template-columns: repeat(2, 1fr);
         grid-gap: 40px;
         max-width: 1140px;
         margin: 40px auto;
         font-family: "Inter", sans-serif;
         box-sizing: border-box;
         }
         form {
         background-color: #fff;
         border: 1px solid #e0e0e0;
         border-radius: 8px;
         padding: 40px;
         font-weight: 500;
         font-size: 16px;
         box-sizing: border-box;
         }
         label {
         display: block;
         margin-bottom: 8px;
         }
         input[type="text"],
         input[type="url"] {
         border: none;
         border-radius: 4px;
         padding: 12px 16px;
         width: 90%;
         font-size: 16px;
         background-color: #f4f4f4;
         margin-bottom: 24px;
         }
         input[type="text"]:focus,
         input[type="url"]:focus {
         outline: none;
         box-shadow: 0 0 0 2px #1371b3;
         }
         .form-buttons {
         display: flex;
         justify-content: flex-end;
         }
         button {
         border: none;
         border-radius: 4px;
         padding: 12px 16px;
         font-size: 16px;
         cursor: pointer;
         }
         .generate-html-btn {
         background-color: #1371b3;
         color: #fff;
         margin-right: 16px;
         }
         .copy-clipboard-btn {
         background-color: #f4f4f4;
         color: #1371b3;
         }
         #output {
         padding: 20px;
         border-radius: 10px;
         font-size: 16px;
         font-family: Arial, sans-serif;
         box-sizing: border-box;
         }
         input[type="button"] {
         padding: 12px 24px;
         background-color: #102c65;
         border: none;
         border-radius: 4px;
         color: #fff;
         font-size: 16px;
         font-weight: 600;
         letter-spacing: 0.5px;
         cursor: pointer;
         transition: background-color 0.2s ease-in-out;
         box-shadow: 0 3px 0 #000206;
         }
         input[type="button"]:hover {
         background-color: #091a3c;
         box-shadow: 0 2px 0 #091a3c;
         }
         input[type="button"]:active {
         background-color: #091a3c;
         box-shadow: none;
         border: 1px solid #091a3c;
         }
        label[for="hideAvatar"] {
    font-family: "Inter", sans-serif;
    font-size: 16px;
    margin-bottom: 8px;
}

#hideAvatar {
  border: none;
  border-radius: 4px;
  padding: 12px 16px;
  width: 700px;
  font-size: 16px;
  background-color: #f4f4f4;
  margin-bottom: 24px;
}

#hideAvatar:focus {
  outline: none;
  box-shadow: 0 0 0 2px #1371b3;
}

      </style>
   </head>
   <body style="display: flex; align-items: center; justify-content: center; height: 100vh;">
      <form>
         <input type="text" id="firstName" placeholder="Enter your first name" />
         <br />
         <input type="text" id="lastName" placeholder="Enter your last name" />
         <br />
         <input type="text" id="role" placeholder="Enter your role" />
         <br />
         <input type="text" id="phone" placeholder="Enter your Phone Number (If applicable)" />
         <br />
         <input type="url" id="meetingURL" placeholder="Enter your Meeting Link (If applicable)" />
         <br />
        <label for="hideAvatar">Hide Headshot:</label>
<select id="hideAvatar" name="hideAvatar">
  <option value="false" selected>No</option>
  <option value="true">Yes</option>
</select>
        <br />
         <input type="button" value="Generate" onclick="generateHtml()" />
         <input type="button" value="Copy HTML" onclick="copyToClipboard()" />
         <input type="button" value="Copy Signature" onclick="copyToClipboardOnly()" />
      </form>
      <br>
      <div id="output" class="output" contenteditable="true"></div>
      <script>
         function generateHtml() {
           const firstName = document.getElementById("firstName").value;
           const lastName = document.getElementById("lastName").value;
           const role = document.getElementById("role").value;
           const phone = document.getElementById("phone").value;
           const meetingURL = document.getElementById("meetingURL").value;
           var avatarURL = (firstName + "-" + lastName).toLowerCase();
           function removeAvatarIfNotAvailable() {
             const avatarImg = document.querySelector('.photo');
             if (avatarImg && avatarImg.complete && avatarImg.naturalHeight === 0) {
               avatarImg.closest('td').remove();
             }
         }
        const hideAvatar = document.getElementById("hideAvatar").value === "true";
if (hideAvatar) {
  avatarURL = "";
  removeAvatarIfNotAvailable();
}

             // Check if the meeting URL is provided
         const meetingURLProvided = meetingURL.trim().length > 0;
         
         // Generate HTML based on whether the meeting URL is provided or not
         const meetingHTML = meetingURLProvided ? `<br>
                 <span id="bookMeeting" class="bookMeeting" style="display:inline;"><a href="${meetingURL}" style="font-weight:normal; font-size: 16px; line-height: 22px; color: #71747A; text-decoration: none;"> 
         &#128197; Book a meeting with me</a></span>` : '';
           
            const numberProvided = phone.trim().length > 0;
           
           const numberHTML = numberProvided ? `<span id="number" class="number" style="display:inline; font-weight:normal; font-size: 16px; line-height: 22px; color: #71747A;">— <a href="tel:${phone}">${phone}</a></span>` : '';
           html = `
            <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
         <html>
         <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         
         </head>
         <body>
         <table style="table-layout: auto; width: 700px; font-family:Helvetica,Arial,sans-serif; font-size: 12px; line-height: 16px; color: #0F2C65; text-align:left;">
           <colgroup>
             <col style="width: 60px">
             <col style="width: 41px">
             <col style="width: 149px">
             <col style="width: 250px">
           </colgroup>
           <tbody>
             <tr>
               <td colspan="4" style="text-align:left;padding-top: 10px;">
                 <p style="color:#71747A;">Kind Regards,</p>
               </td>
             </tr>
             <tr>
               <td colspan="1" style="text-align:left; vertical-align:bottom; padding-bottom:16px;">
         <img class="photo" src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/Profiles/${avatarURL}.jpg" height="100" width="100" style="max-width: 100px !important; max-height: 100px !important;display:inline; border-radius: 20px; padding-right:5px;" alt="Profile Photo" onerror="removeImageDiv(this)">
         </td>
               <td colspan="4" style="text-align:left;vertical-align:middle;padding-bottom:16px;">
                 <span id="fname" class="fname" style="display:inline; font-size: 16px; line-height: 22px; color: #0F2C65;font-weight: bold;">${firstName}</span>&nbsp;<span id="lname" class="lname" style="display:inline; font-size: 16px; line-height: 22px; color: #0F2C65;font-weight: bold;">${lastName}</span>
                 <br>
                 <span id="position" class="position" style="display:inline; font-weight:normal; font-size: 16px; line-height: 22px; color: #71747A;">${role}</span>
                 ${numberHTML}
                 ${meetingHTML}
               </td>
             </tr>
             <tr>
               <td colspan="1" style="text-align: left;vertical-align:middle;width:100px;display:block;"><a href="https://www.rexsoftware.com"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/RexLogoDarkMode.png" height="40" width="100" style="display:inline;" alt="Rex Logo"></a></td>
               <td colspan="3" style="text-align:left;vertical-align: center; padding-left: 20px;padding-bottom: 6px;">
                 <p style="display:inline; font-size: 13px; line-height: 15px;">Together in partnership with agents, we help people find, change and make home.</p>
               </td>
             </tr>
<tr>
               <td colspan="4">
                 <div style="width: 700px;">
    <br><table cellpadding="0" cellspacing="0" border="0" style="width: 700px; border-collapse: collapse;">
        <tbody><tr>
            
            <td style="border-bottom: 2px #EAE5DA dotted; line-height: 0; font-size: 0;">
                &nbsp;
            </td>
        </tr>
    </tbody></table>
</div>
</td>
             </tr>
<tr>
  <td style="text-align: left; vertical-align: middle;">
    <p style="color: #71747A; margin: 0;">Products:</p>
  </td>
  <td width="100%" style="text-align: left; vertical-align: middle;">
<br>
    <a href="https://www.rexsoftware.com/uk/products/estate-agency-crm"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/Sales-Lettings-Dark-Mode.png" height="26" width="102" style="max-width: 102px !important; max-height: 26px !important; vertical-align: middle; padding-right:10px;" alt="Rex Sales and Rentals CRM"></a>&nbsp;
    <a href="https://www.rexsoftware.com/uk/products/property-management"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/PM-Dark-Mode.png" height="26" width="105" style="max-width: 105px !important; max-height: 26px !important; vertical-align: middle; padding-right:10px;" alt="Rex Property Management"></a>&nbsp;
    <a href="https://www.rexsoftware.com/uk/products/property-marketing"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/Reach-Dark-Mode.png" height="26" width="67" style="max-width: 67px !important; max-height: 26px !important; vertical-align: middle; padding-right:10px;" alt="Rex Reach"></a>&nbsp;
    <a href="https://www.rexsoftware.com/uk/products/estate-agent-website"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/Websites-Dark-Mode.png" height="26" width="84" style="max-width: 84px !important; max-height: 26px !important; vertical-align: middle;" alt="Rex Websites"></a>
      <br>
      <br>
  </td>
</tr>
             <tr>
               <td colspan="4">
                 <div style="width: 700px;">
    <table cellpadding="0" cellspacing="0" border="0" style="width: 700px; border-collapse: collapse;">
        <tr>
            <td style="border-bottom: 2px #EAE5DA dotted; line-height: 0; font-size: 0;">
                &nbsp;
            </td>
        </tr>
    </table>
</div>
</td>
             </tr>
               
  </tbody>
             </table>
  <table width="600" cellpadding="0" cellspacing="0" style="font-family:Helvetica,Arial,sans-serif; font-size: 12px; line-height: 16px; color: #0F2C65; text-align:left;">
  <tbody><tr>
    <td width="50%" style="text-align: left;">
    <p><b>London</b><br></p>
      <p style="color: #71747A;">3rd Floor, 51 Moorgate,<br>
London, EC2R 5BJ.
        <br>
        Company Number: 11241778</p>
    </td><td width="50%" style="text-align: left;">
      <p><b>Brisbane</b></p>
      <p style="color: #71747A;">Waterloo Junction,<br>Level 1/4-12 Commercial Rd, Newstead,<br>
      Brisbane, 4006.<br>
      ABN: 97 145 420 284</p>
    </td>
    
  </tr>
             
             <tr>
               <td colspan="4">
                 <div style="width: 700px;">
    <table cellpadding="0" cellspacing="0" border="0" style="width: 700px; border-collapse: collapse;">
        <tr>
            <br>
            <td style="border-bottom: 2px #EAE5DA dotted; line-height: 0; font-size: 0;">
                &nbsp;
            </td>
        </tr>
             <tr>
               <td colspan="4" style="text-align: left;">
                  
                 <p style="font-size: 9px; line-height:11px; color: #71747A;">
                     <br>It's likely that if Rex sent you an email, we were intending to, and while we know everyone loves receiving mail, there could also be a chance this wasn't supposed to be addressed to you. We like to share, but confidentiality is important to us too. So if this email isn't the one you were expecting, please delete it, refrain from sharing it, and maybe let us know, so we can fix that broken 'e' on our keyboard. Also, we're aware this email has been sent from someone at Rex, and while we encourage opinions, and the occasional desk beer, we also need to let you know the writer and/or sender's opinion may not be the opinion of Rex as a company. This company is registered in England and Wales where our registered address is: 10 John Street, London, United Kingdom, WC1N 2EB – but please don't send mail owls here, we won't receive it.
                 </p>
               </td>
             </tr>
             <tr>
               <td colspan="4" style="text-align: left;padding-top: 10px;">
                 <a href="https://2jvr.short.gy/uI4fh5"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/linkedin-dark-mode.png" height="26" width="26" style="max-height:26px !important; max-width:26 !important; padding-right: 5px;mso-padding-right-alt:5px;" alt="linkedIn"></a>
                 <a href="https://2jvr.short.gy/rRfIoR"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/facebook-dark-mode.png" height="26" width="26" style="max-height:26px !important; max-width:26 !important; padding-right: 5px;mso-padding-right-alt:5px;" alt="Facebook"></a>
                 <a href="https://2jvr.short.gy/R3fp2o"><img src="https://7804200.fs1.hubspotusercontent-na1.net/hubfs/7804200/Staff-Email-Signature/insta-dark-mode.png" height="26" width="26" style="max-height:26px !important; max-width:26 !important; padding-right: 5px;" alt="Instagram"></a>
               </td>
             </tr>
         </table>
         </body>
         </html>
         </div>
           `;
           document.getElementById("output").innerHTML = html;
         }
         async function copyToClipboardOnly() {
  try {
    const outputElement = document.getElementById("output");

    // Select the content within the output element
    const range = document.createRange();
    range.selectNodeContents(outputElement);
    const selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);

    // Copy the selected content to the clipboard
    const success = await document.execCommand("copy");

    // Clear the selection
    selection.removeAllRanges();

    if (success) {
      alert("Copied to clipboard!");
    } else {
      throw new Error("Copy failed");
    }
  } catch (err) {
    console.error("Failed to copy to clipboard: ", err);
  }
}
         async function copyToClipboard() {
           try {
             await navigator.clipboard.writeText(document.getElementById("output").innerHTML);
             alert("Copied to clipboard!");
           } catch (err) {
             console.error("Failed to copy to clipboard: ", err);
           }
         }
         function removeImageDiv(imgElement) {
         const parentElement = imgElement.parentElement;
         parentElement.remove();
         }
      </script>
   </body>
</html>
