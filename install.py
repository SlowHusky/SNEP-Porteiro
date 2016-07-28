import os
import time

print "Bem-vindo ao instalador do modulo de porteiro eletronico para SNEP!"
print "Verificando se possui alguma versao instalada..."
path = '/var/www/html/snep/modules'
os.chdir(path)
print os.getcwd()

if os.path.exists('/var/www/html/snep/modules/porteiro'):
    print "O modulo ja esta instalado."
    print "Deseja remover o modulo do sistema?"
    resp = raw_input("Sim ou nao? ")
    resp.lower()
    if resp == "sim":
        print "Deletando..."
        print "..."
        os.system("rm -r porteiro")
        print "Encerrando o programa!"
        quit()
    else:
        print "Adeus!"
        quit()

print "Nao apresenta versao instalada. Preparando para instalar modulo...\n"

url = 'www.camtecnologia.com.br/downloads/pacote.tar'
print "Se conectando com o servidor em " + url
print "\nIniciando download de arquivos ...\n"
os.system("mkdir porteiro")
os.chdir(path+'/porteiro')
time.sleep(2)
print os.getcwd()
os.system("wget "+url)

print "Download efetuado!"

print "Iniciando a extracao dos arquivos"
print "...\n"
time.sleep(2)
os.system("mv pacote.tar pacote.tar.gz") 
os.system("tar -xf pacote.tar.gz")
print "Arquivo instalado"
print "Executando alteracao no banco de dados do SNEP!"
os.system('mysql -u snep --password=sneppass snep < banco.sql')
print "Banco pronto"



print "Seu modulo esta pronto para o funcionamento!"

