/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     21/1/2017 14:15:52                           */
/*==============================================================*/


drop table if exists amigos;

drop table if exists fotos;

drop table if exists gvsc;

drop table if exists juegos;

drop table if exists megusta;

drop table if exists prestamos;

drop table if exists publicaciones;

drop table if exists retar;

drop table if exists sesiones;

drop table if exists users;

/*==============================================================*/
/* Table: amigos                                                */
/*==============================================================*/
create table amigos
(
   id                   int not null,
   use_id               int not null,
   fecha_am             timestamp,
   estado_am            bool,
   primary key (id, use_id)
);

/*==============================================================*/
/* Table: fotos                                                 */
/*==============================================================*/
create table fotos
(
   id_fo                int not null,
   id                   int not null,
   url_fo               varchar(255) not null,
   fecha_fo             timestamp not null,
   primary key (id_fo)
);

/*==============================================================*/
/* Table: gvsc                                                  */
/*==============================================================*/
create table gvsc
(
   clima                char(20) not null,
   genero               char(20) not null
);

/*==============================================================*/
/* Table: juegos                                                */
/*==============================================================*/
create table juegos
(
   id_ju                bigint not null,
   id                   int not null,
   titulo_ju            char(255) not null,
   estado_ju            char(10) not null,
   primary key (id_ju, id)
);

/*==============================================================*/
/* Table: megusta                                               */
/*==============================================================*/
create table megusta
(
   id                   int not null,
   id_pub               int not null,
   fecha_me             timestamp,
   primary key (id, id_pub)
);

/*==============================================================*/
/* Table: prestamos                                             */
/*==============================================================*/
create table prestamos
(
   id_ju                bigint not null,
   jue_id               int not null,
   id                   int not null,
   use_id               int not null,
   fecha_pre            timestamp not null
);

/*==============================================================*/
/* Table: publicaciones                                         */
/*==============================================================*/
create table publicaciones
(
   id_pub               int not null,
   id                   int not null,
   detalle_pub          text not null,
   primary key (id_pub)
);

/*==============================================================*/
/* Table: retar                                                 */
/*==============================================================*/
create table retar
(
   id_pub               int not null,
   id                   int not null,
   fecha_re             timestamp,
   primary key (id_pub, id)
);

/*==============================================================*/
/* Table: sesiones                                              */
/*==============================================================*/
create table sesiones
(
   id                   int not null,
   fecha_se             timestamp not null,
   ip_se                varchar(50) not null,
   dispositivo_se       char(20) not null
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   id                   int not null auto_increment,
   name                 varchar(100) not null,
   email                varchar(200) not null,
   password             varchar(255) not null,
   remember_token       varchar(100),
   created_at           datetime default current_timestamp,
   updated_at           timestamp default current_timestamp on update current_timestamp,
   fb_id                bigint,
   primary key (id)
);

alter table amigos add constraint fk_amigos foreign key (use_id)
      references users (id) on delete restrict on update restrict;

alter table amigos add constraint fk_amigos2 foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table fotos add constraint fk_sube foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table juegos add constraint fk_tiene foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table megusta add constraint fk_megusta foreign key (id_pub)
      references publicaciones (id_pub) on delete restrict on update restrict;

alter table megusta add constraint fk_megusta2 foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table prestamos add constraint fk_es foreign key (id_ju, jue_id)
      references juegos (id_ju, id) on delete restrict on update restrict;

alter table prestamos add constraint fk_presta foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table prestamos add constraint fk_recibe foreign key (use_id)
      references users (id) on delete restrict on update restrict;

alter table publicaciones add constraint fk_puede foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table retar add constraint fk_retar foreign key (id)
      references users (id) on delete restrict on update restrict;

alter table retar add constraint fk_retar2 foreign key (id_pub)
      references publicaciones (id_pub) on delete restrict on update restrict;

alter table sesiones add constraint fk_genera foreign key (id)
      references users (id) on delete restrict on update restrict;

