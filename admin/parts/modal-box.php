<!-- modal box -->
<div class="modal fade" id="myModal" role="dialog"">
    <div class="modal-dialog" id="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crop image</h4>
            </div>

            <!-- picture in modal box -->
            <div class="modal-body">
                <div class="img-wrap-modal">
                    <img id="img" src="">
                    <div id="box"></div>
                </div>
            </div>
            <!-- picture in modal box -->

            <!-- >>**<< -->
            <div class="modal-footer">
                <input type="hidden" value="" id="top" name="top">
                <input type="hidden" value="" id="left" name="left">
                <input type="hidden" value="" id="right" name="right">
                <input type="hidden" value="" id="bottom" name="bottom">
                <button type="button" class="btn btn-success" data-dismiss="modal" name="crop" id="crop">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <!-- >>**<< -->
        </div>
    </div>
</div>
<!-- modal box -->