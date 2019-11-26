package com.example.senai.api_conexao_android;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.android.volley.VolleyError;

import java.util.HashMap;

public class InserirActivity extends AppCompatActivity implements  IDadosEventListener{

    private EditText etNome, etSobrenome, etCpf;
    private ProgressBar pb;
    private TextView tvResultado;
    //private RadioGroup rgSexo;

    private InserirController inserirController;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_inserir);
        this.inserirController = new InserirController(this);
        this.etNome = findViewById(R.id.et_nome);
        this.etSobrenome = findViewById(R.id.et_sobrenome);
        this.etCpf = findViewById(R.id.et_cpf);
    }

    public void enviar(View view) {
        //String sexo = (this.rgSexo.getCheckedRadioButtonId() == R.id.sexo_m?"M":"F");
        HashMap<String,String> hm = new HashMap<>();
        hm.put("cpf", etCpf.getText().toString());
        hm.put("nome", etNome.getText().toString());
        hm.put("Sobrenome", etSobrenome.getText().toString());

        this.pb.setVisibility(ProgressBar.VISIBLE);
        this.inserirController.enviarParaPHP(hm);
    }
    @Override
    public void eventoRetornouOk(String response) {
        this.pb.setVisibility(ProgressBar.GONE);
        this.tvResultado.setText(response);
    }

    @Override
    public void eventoRetornouErro(VolleyError error) {
        this.pb.setVisibility(ProgressBar.GONE);
        this.tvResultado.setText(error.toString());
    }


}
