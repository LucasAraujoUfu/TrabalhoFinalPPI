CREATE TABLE baseDeEnderecosAjax(
   bairro varchar(50),
   cidade varchar(50),
   estado char(10)
)ENGINE=InnoDB;

CREATE TABLE anunciante(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf char(14) UNIQUE,
   email varchar(50) UNIQUE,
   hash_senha varchar(255),
   telefone varchar(18)
)ENGINE=InnoDB;

CREATE TABLE categoria(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   descricao varchar(300)
)ENGINE=InnoDB;

CREATE TABLE anuncio(
   codigo int PRIMARY KEY auto_increment,
   titulo varchar(50),
   descricao varchar(300),
   preco decimal(10,2),
   data_hora datetime DEFAULT NULL,
   cep char(10),
   bairro varchar(50),
   cidade varchar(50),
   estado char(10),
   codigo_categoria int not null,
   FOREIGN KEY (codigo_categoria) REFERENCES categoria(codigo) ON DELETE CASCADE,
   codigo_anunciante int not null,
   FOREIGN KEY (codigo_anunciante) REFERENCES anunciante(codigo) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE interesse(
   codigo int PRIMARY KEY auto_increment,
   mensagem varchar(300),
   data_hora datetime DEFAULT NULL,
   contato varchar(300),
   codigo_anuncio int not null,
   FOREIGN KEY (codigo_anuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE foto(
   nomeArqFoto varchar(50),
   codigo_anuncio int not null,
   FOREIGN KEY (codigo_anuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
)ENGINE=InnoDB;