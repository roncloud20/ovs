<?php 
    $title = "Frequently Asked Questions";
    require_once "assets/header.php";
?>
<style>
    .accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 18px;
      width: 90%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
      margin: 0 50px;
    }
    
    .active, .accordion:hover {
      background-color: #ccc; 
    }
    
    .panel {
      padding: 0 18px;
      display: none;
      background-color: white;
      overflow: hidden;
      margin: 0 50px;
      width: 90%;
    }
    .divider {
      height:100px;
    }
    </style>

    
    <h2>Frequently Asked Questions</h2>
    
    <button class="accordion">What is an online voting web app?</button>
    <div class="panel">
      <p> An online voting web app is a web-based application that allows users to cast their votes electronically over the internet.</p>
    </div>
    
    <button class="accordion">Is online voting secure?</button>
    <div class="panel">
      <p>Online voting can be secure if the web app is properly designed with security in mind, and if appropriate measures are taken to ensure the authenticity and integrity of the votes. However, there are also potential security risks associated with online voting, such as hacking, fraud, and tampering, so it is important to implement strong security measures.</p>
    </div>
    
    <button class="accordion">How does online voting work?</button>
    <div class="panel">
      <p>Online voting typically involves the use of a web-based application that allows eligible voters to cast their ballots electronically over the internet. The web app may use various authentication and security measures to ensure the integrity and authenticity of the votes.</p>
    </div>

    <button class="accordion"> What are the benefits of online voting?</button>
    <div class="panel">
      <p>Online voting can offer a number of benefits, such as increased accessibility, convenience, and efficiency. It can also help to reduce the costs and resources associated with traditional voting methods.</p>
    </div>

    <button class="accordion">What are the drawbacks of online voting?</button>
    <div class="panel">
      <p>Online voting can also have drawbacks, such as potential security risks, technical issues, and concerns about the accuracy and validity of the results. It can also present challenges for those who do not have access to the internet or who are not comfortable with using technology.</p>
    </div>

    <button class="accordion">What security measures should be in place for an online voting web app?</button>
    <div class="panel">
      <p>Security measures for an online voting web app may include user authentication, encryption of data transmission, network security, and measures to prevent hacking and tampering. It may also involve the use of multi-factor authentication, such as the combination of a password and a unique code sent via text message.</p>
    </div>

    <button class="accordion">How can the authenticity and integrity of online votes be ensured?</button>
    <div class="panel">
      <p>Authenticity and integrity of online votes can be ensured by implementing appropriate security measures, such as user authentication, encryption of data transmission, and measures to prevent hacking and tampering. It may also involve the use of digital signatures or other methods to verify the identity of voters and the integrity of the votes.</p>
    </div>

    <button class="accordion">How can I ensure that my online vote is counted?</button>
    <div class="panel">
      <p>To ensure that your online vote is counted, make sure to follow the instructions provided by the web app, including any authentication or security measures. It is also important to ensure that you are using a secure and trusted web app, and to report any issues or concerns to the relevant authorities.</p>
    </div>

    <div class='divider'></div>
    
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }
    </script>

<?php 
require_once "assets/footer.php";
?>