$(document).ready(function() {
    $('#ci_persona').on('blur', function() {
        const ci = $(this).val();
        if (ci) {
            $.ajax({
                url: `/buscar-persona/${ci}`,
                method: 'GET',
                success: function(data) {
                    $('#nombres').val(data.nombres);
                    $('#apellido_paterno').val(data.apellido_paterno);
                    $('#apellido_materno').val(data.apellido_materno);

                },
                error: function() {
                    alert('Persona no encontrada');
                    $('#nombres').val('');
                    $('#apellido_paterno').val('');
                    $('#apellido_materno').val('');

                }
            });
        }
    });
});