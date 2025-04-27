{{-- Create and Edit Modal --}}
<div class="modal fade modal-lg" id="modal-assesment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jawaban Asesmen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" id="id" name="ship_id" />
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <a style="text-decoration: none;" href="#" data-bs-toggle="modal" data-bs-target="#detailModal">
                            <div class="row" style="align-items: center">
                                <div class="col-md-1">
                                    1
                                </div>
                                <div class="col-md-3">
                                    Business Process Knowledge
                                </div>
                                <div class="col-md-4">
                                    Pengetahuan, kemampuan dan keahlian terkait identiﬁkasi, penerapan, dan pengukuran.
                                </div>
                                <div class="col-md-4">
                                    {{-- make progress bar --}}
                                    <label class="form-label">Progress</label>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <label class="form-label">0 Dari 8 Pertanyaan Terjawab</label>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Jawaban Asesmen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="ships-table">
                    <thead class="border-top">
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>jawaban</th>
                            <th>Deskripsi Jawaban</th>
                            <th>Evidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Apakah Anda mengetahui teori perancangan struktur organisasi dan analisa pekerjaan yang efektif?</td>
                            <td>Ya</td>
                            <td>Saya paham akan konsep Business Process</td>
                            <td><a href="#">Dokumen Evidence</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Apakah Anda mengetahui teori perancangan struktur organisasi dan analisa pekerjaan yang efektif?</td>
                            <td>Ya</td>
                            <td>Saya paham akan konsep Business Process</td>
                            <td><a href="#">Dokumen Evidence</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Apakah Anda mengetahui teori perancangan struktur organisasi dan analisa pekerjaan yang efektif?</td>
                            <td>Ya</td>
                            <td>Saya paham akan konsep Business Process</td>
                            <td><a href="#">Dokumen Evidence</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>