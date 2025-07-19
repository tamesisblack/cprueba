<div class="modal fade" 
    id="info" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="titulo" 
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      </div>
    </div>
</div>

<script>
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');}
        );
    });
</script>