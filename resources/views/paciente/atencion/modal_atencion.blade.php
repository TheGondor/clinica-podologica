<div class="modal fade bd-example-modal-lg" id="modal_atencion" tabindex="-1" role="dialog" aria-labelledby="modal_atencion" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content py-2 bg-modal">
      <div class="modal-header bg-modal">
        <div class="modal-title">Atencion Paciente</div>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body bg-modal">
          <form class="needs-validation row" id="formula_atencion" role="form">
            <div class="form-group col-sm-12 col-md-4">
                <label>Fecha</label>
                <input type="date" class="form-control" id="a_fecha_atencion" name="atencion_fecha" value="{{date('Y-m-d',time())}}" required>
              </div>
              <div class="form-group col-sm-12 col-md-4">
                <label>P/A</label>
                <input type="text" class="form-control" id="a_pa_atencion" placeholder="Ingresar PA" name="atencion_pa">
              </div>
              <div class="form-group col-sm-12 col-md-4">
                  <label>Pulso Radial</label>
                  <input type="number" class="form-control" id="a_pulso_radial" placeholder="Ingresar Pulso Radial" name="atencion_pulso_radial">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Peso</label>
                  <input type="number" class="form-control" id="a_peso" placeholder="Ingresar Peso" name="atencion_peso">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Pulso Pedio (d)</label>
                  <input type="text" class="form-control" id="a_pulso_pedio_d" placeholder="Ingresar Pulso Pedio" name="atencion_pedio_d">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Pulso Pedio (i)</label>
                  <input type="text" class="form-control" id="a_pulso_pedio_i" placeholder="Ingresar Pulso Pedio" name="atencion_pedio_i">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Sensibilidad (d)</label>
                  <input type="text" class="form-control" id="a_sensibilidad_d" placeholder="Ingresar Sensibilidad" name="atencion_sensibilidad_d">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Sensibilidad (i)</label>
                  <input type="text" class="form-control" id="a_sensibilidad_i" placeholder="Ingresar Sensibilidad" name="atencion_sensibilidad_i">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>T Podal</label>
                  <input type="number" class="form-control" id="a_t_podal" placeholder="Ingresar T Podal" name="atencion_t_podal">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Atencion Basica</label>
                  <input type="text" class="form-control" id="a_atencion_basica" placeholder="Ingresar Atencion Basica" name="atencion_podal">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Curacion</label>
                  <input type="text" class="form-control" id="a_curacion" placeholder="Ingresar Curacion" name="atencion_curacion">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Colocacion Puente</label>
                  <input type="text" class="form-control" id="a_colocacion_puente" placeholder="Ingresar Colocacion Puente" name="atencion_colocacion">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Resecado</label>
                  <input type="text" class="form-control" id="a_resecado" placeholder="Ingresar Resecado" name="atencion_resecado">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Enucleacion</label>
                  <input type="text" class="form-control" id="a_enucleacion" placeholder="Ingresar Enucleasion" name="atencion_enucleasion">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Devastado Ungueal</label>
                  <input type="text" class="form-control" id="a_devastado_ungueal" placeholder="Ingresar Devastado Ungueal" name="atencion_devastado">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Masoterapia</label>
                  <input type="text" class="form-control" id="a_masoterapia" placeholder="Ingresar Masoterapia" name="atencion_masoterapia">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Espiculoectomia</label>
                  <input type="text" class="form-control" id="a_espiculoectomia" placeholder="Ingresar Espiculoectomia" name="atencion_espiculoectomia">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Analgesia</label>
                  <input type="text" class="form-control" id="a_analgesia" placeholder="Ingresar Analgesia" name="atencion_analgesia">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Colocacion Acrilico</label>
                  <input type="text" class="form-control" id="a_colocacion_acrilico" placeholder="Ingresar Colocacion Acrilico" name="atencion_acrilico">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Colocacion Banda</label>
                  <input type="text" class="form-control" id="a_colocacion_banda" placeholder="Ingresar Colocacion Banda" name="atencion_banda"> 
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>C. Bracket</label>
                  <input type="text" class="form-control" id="a_cbracket" placeholder="Ingresar C Bracket" name="atencion_bracket">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>C. Policarboxilato</label>
                  <input type="text" class="form-control" id="a_cpolicarboxilato" placeholder="Ingresar C Policarboxilato" name="atencion_policarboxilato">
                </div>
                <div class="form-group col-sm-12 col-md-4">
                  <label>Observacion</label>
                  <input type="text" class="form-control" id="a_observacion" placeholder="Ingresar Observacion" name="atencion_descripcion">
                </div>
              </br>
          </form>
      </div>
      <div class="modal-footer bg-modal">
        <input class="btn btn-primary" type="submit" id="agregar_atencion" form="formula_atencion" value="Agregar Atencion">
        <input class="btn btn-primary" type="submit" id="editar_atencion" form="formula_atencion" value="Editar Atencion">
        <button type="button" class="btn btn-danger" data-dismiss="modal" class="btn">Cerrar</button>
      </div>
    </div>
  </div>
</div>