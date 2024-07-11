</div>
<!-- / Content -->
<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            <a href="#" target="_blank" class="footer-link fw-medium">Company Profile</a>
        </div>
        <div class="d-none d-lg-inline-block">
            <a href="#" class="footer-link me-4" target="_blank">Test</a>
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- / Layout wrapper -->
</div>

    <!-- Core JS -->
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Main JS -->
    <script src="{{ url('assets/js/main.js') }}"></script>
    <script src="{{ url('assets/js/dashboards-analytics.js') }}"></script>

    <script>
        // CLOCK
        function fixNumClock(num) {
            return num < 10 ? '0' + num : num;
        }

        function monthNumToString(num) {
            switch (num) {
                case 1:
                    return 'Januari';
                case 2:
                    return 'Februari';
                case 3:
                    return 'Maret';
                case 4:
                    return 'April';
                case 5:
                    return 'Mei';
                case 6:
                    return 'Juni';
                case 7:
                    return 'Juli';
                case 8:
                    return 'Agustus';
                case 9:
                    return 'September';
                case 10:
                    return 'Oktober';
                case 11:
                    return 'November';
                case 12:
                    return 'Desember';
            }
        }

        function initClock() {
            setInterval(() => {
                const dateInstance = new Date();
                const year = dateInstance.getFullYear();
                const month = monthNumToString((dateInstance.getMonth() < 12 ? dateInstance.getMonth() + 1 : dateInstance.getMonth()));
                const date = fixNumClock(dateInstance.getDate());
                const hours = fixNumClock(dateInstance.getHours());
                const minutes = fixNumClock(dateInstance.getMinutes());
                const seconds = fixNumClock(dateInstance.getSeconds());

                const currentDatetime = `${date} ${month} ${year} ${hours}:${minutes}:${seconds}`;
                $('#clock-realtime').html(currentDatetime);
            }, 1000);
        }
        initClock();
        // END CLOCK

        // LOADING
        document.addEventListener('DOMContentLoaded', function() {
            const loadingElement = document.getElementById('loading');
            const contentElement = document.getElementById('content');

            window.addEventListener('load', function() {
                loadingElement.classList.add('fade-out');
                contentElement.classList.add('show');

                setTimeout(() => {
                    loadingElement.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }, 100);
            });
        });
        // END LOADING
    </script>
</body>
</html>
