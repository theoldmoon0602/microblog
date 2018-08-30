
create table if not exists users(
  id integer primary key,
  username text unique not null,
  password text unique not null
);

create table if not exists posts(
  id integer primary key,
  user text not null,
  content text not null
);
