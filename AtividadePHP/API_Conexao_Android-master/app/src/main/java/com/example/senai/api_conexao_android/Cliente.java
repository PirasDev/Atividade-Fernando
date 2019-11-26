package com.example.senai.api_conexao_android;

public class Cliente {
    public static final int LIMIT_CPF = 11;
    public static final int LIMIT_NOME = 255;
    public static final int LIMIT_SOBRENOME = 255;
    private String cpf, nome, sobrenome;


    public Cliente(String cpf, String nome, String sobrenome) {
        if(cpf.length() > LIMIT_CPF) cpf = cpf.substring(0,LIMIT_CPF);
        if(nome.length() > LIMIT_NOME) nome = nome.substring(0,LIMIT_NOME);
        if(sobrenome.length() > LIMIT_SOBRENOME) sobrenome = sobrenome.substring(0,LIMIT_SOBRENOME);

        this.cpf = cpf;
        this.nome = nome;
        this.sobrenome = sobrenome;
    }

    public String getNome() {
        return nome;
    }

    public String getCpf() {
        return cpf;
    }

    public String getEndereco() {
        return sobrenome;
    }

}
