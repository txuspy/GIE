<div class="modal fade" tabindex="-1" role="dialog" id="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                @yield('title')
            </div>

            <div class="modal-body">
                <div id="loading" style="margin:35px;">
                    <h3>@yield('body')</h3>
                    <div class="progress progress-striped active page-progress-bar">
                        <div class="progress-bar" style="width: 100%;"></div>
                        <div class="percent">0%</div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                @yield('footer')
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->