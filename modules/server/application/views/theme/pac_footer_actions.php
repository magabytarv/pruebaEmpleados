<script type="text/javascript">
  function base_recargar() {
    location.reload();
  }
    
  function base_salir() {
    try {
      if (navigator.userAgent.indexOf('Safari')!=-1) {
        parent.principal.VerificarCerrar();
      }
    }
    catch (err) {
      console.log(err);
    };
    
    window.parent.close();
  }
</script>