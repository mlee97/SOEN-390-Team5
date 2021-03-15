
<!-- Modal button -->
<button type="button" class="btn btn-outline-info btn-lg" data-toggle="modal"
        data-target="#backlog-tables">Order Backlog
</button>

<!--
            modal for showing backlog table
         -->
<div class="modal fade" id="backlog-tables" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- header of modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Backlog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <!-- body of modal -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="card text-center mt-4">
                        <!-- it holds the tabs -->
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <!-- tab for showing materials -->
                                    <a class="nav-link active" data-toggle="tab" href="#materials">Materials</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane fade show active" id="materials">
                                <!-- real table for showing the materials -->
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Estimated Arrival Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
