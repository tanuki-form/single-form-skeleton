<?php
$siteKey = $form->helper->getTurnstileSiteKey();
?>

<script>
  (() => {
    const form = document.getElementById("inquiry-form");
    const input = document.createElement("div");
    input.className = "cf-turnstile";
    input.setAttribute("data-sitekey", "<?php echo $siteKey; ?>");
    form.append(input);
  })();
</script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
