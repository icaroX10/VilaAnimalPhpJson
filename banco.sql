Create table telefonepf(
	id_telpf int(11) not null auto_increment primary key,
	telefone_id int(11) not null,
	pessoaf_id int(11) not null,
	foreign key (telefone_id) references telefone (id),
	foreign key (pessoaf_id) references pessoaf (id_pes_f)
);

Create table telefonepj(
	id_telpj int(11) not null auto_increment primary key,
	telefone_id int(11) not null,
	pessoaj_id int(11) not null,
	foreign key (telefone_id) references telefone (id),
	foreign key (pessoaj_id) references pessoaj (id_pes_j)
);

Create table enderecopf(
	id_endpf int(11) not null auto_increment primary key,
	endereco_id int(11) not null,
	pessoaf_id int(11) not null,
	foreign key (endereco_id) references endereco (id),
	foreign key (pessoaf_id) references pessoaf (id_pes_f)
);


Create table enderecopj(
	id_endpj int(11) not null auto_increment primary key,
	endereco_id int(11) not null,
	pessoaj_id int(11) not null,
	foreign key (endereco_id) references endereco (id),
	foreign key (pessoaj_id) references pessoaj (id_pes_j)
);


