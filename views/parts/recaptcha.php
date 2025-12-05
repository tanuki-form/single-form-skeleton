<?php
$recaptchaOptions = getOptions("pre-handlers/recaptcha");
$siteKey = $options["config"]["siteKey"];
?>

<script src="https://www.google.com/recaptcha/enterprise.js?render=<?php echo $siteKey; ?>"></script>
<script>
  document.getElementById("inquiry-form").querySelector("button[type='submit'][value='send']").addEventListener("click", e => {
    e.preventDefault();

    const form = e.target.closest("form");

    grecaptcha.enterprise.ready(async () => {
      const token = await grecaptcha.enterprise.execute("<?php echo $siteKey; ?>", {action: "contact_form"});

      const tokenInput = document.createElement("input")
      tokenInput.type = "hidden";
      tokenInput.name = "recaptcha-token";
      tokenInput.value = token;
      form.append(tokenInput);

      const actionInput = document.createElement("input");
      actionInput.type = "hidden";
      actionInput.name = "action";
      actionInput.value = "send";
      form.append(actionInput);

      form.submit();
    });
  });
</script>
