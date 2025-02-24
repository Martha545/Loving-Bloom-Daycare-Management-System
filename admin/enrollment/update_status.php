<div class="container-fluid">
    <form action="" id="update_status_form">
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : "" ?>">
        <div class="form-group">
            <label for="status" class="control-label text-navy">Status</label>
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="0" <?= isset($_GET['status']) && $_GET['status'] == 0 ? "selected" : "" ?>>Pending</option>
                <option value="1" <?= isset($_GET['status']) && $_GET['status'] == 1 ? "selected" : "" ?>>Confirmed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
<script>
    $(function(){
        $('#update_status_form').submit(function(e){
            e.preventDefault();
            start_loader();

            var el = $('<div>');
            el.addClass("pop-msg alert").hide();
            console.log(_base_url_ + "classes/Master.php?f=update_status"); // Log the URL

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_status",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                error: function(err){
                    console.log(err); // Log the error response
                    alert_taost("An error occurred while saving the data.", "error");
                    end_loader();
                },
                success: function(resp){
                    if(resp.status === 'success'){
                        location.reload(); // Reload to reflect changes
                    } else {
                        el.addClass("alert-danger").text(resp.msg || "An error occurred due to an unknown reason.");
                        $('#update_status_form').prepend(el);
                    }
                    el.show('slow');
                    end_loader();
                }
            });
        });
    });
</script>
