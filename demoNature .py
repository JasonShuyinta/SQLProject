from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time

driver = webdriver.Chrome()
driver.get("http://localhost/progetto/")
driver.maximize_window()



time.sleep(2)

link = driver.find_element_by_name("nome").send_keys("admin")
link = driver.find_element_by_name("password").send_keys("admin")
link = driver.find_element_by_name("login").click()

time.sleep(2)

driver.execute_script("window.scrollTo(0,document.body.scrollHeight)")

time.sleep(2)


################################
#inserisci specie animale
driver.find_element_by_link_text("Amministrazione").click()
time.sleep(2)
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[9]/div/a[1]').click()
time.sleep(2)
driver.find_element_by_name("Classe").send_keys("REPTILIA")
driver.find_element_by_name("NomeLatino").send_keys("Nuova Viperw")
driver.find_element_by_name("NomeItaliano").send_keys("Vipera Velenosa")
driver.find_element_by_name("AnnoClassificazione").send_keys("1999")
driver.find_element_by_name("LivelloVulnerabilita").send_keys("Alto")
driver.find_element_by_name("LinkWikipedia").send_keys("www.questoèunlink.it")
driver.find_element_by_name("Peso").send_keys("30")
driver.find_element_by_name("Altezza").send_keys("1.30")
driver.find_element_by_name("Numerosita").send_keys("300")
driver.find_element_by_name("NomeHabitat").send_keys("Lago")

time.sleep(8)

driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()

time.sleep(4)

driver.find_element_by_xpath('/html/body/div/div/div/form/p[3]/a').click()
#############################


#inserimento specie vegetale
driver.find_element_by_link_text("Amministrazione").click()
time.sleep(4)
driver.find_element_by_link_text("Inserisci Specie Vegetale").click()
time.sleep(4)
driver.find_element_by_name("Classe").send_keys("VEGETALIS")
driver.find_element_by_name("NomeLatino").send_keys("Alberuwee")
driver.find_element_by_name("NomeItaliano").send_keys("Albero Raro")
driver.find_element_by_name("AnnoClassificazione").send_keys("2012")
driver.find_element_by_name("LivelloVulnerabilita").send_keys("Medio")
driver.find_element_by_name("LinkWikipedia").send_keys("www.altroLink.it")
driver.find_element_by_name("Altezza").send_keys("1,34")
driver.find_element_by_name("Diametro").send_keys("0,30")
driver.find_element_by_name("NomeHabitat").send_keys("Lago")
time.sleep(8)
driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()
time.sleep(2)
########################

driver.find_element_by_link_text("Nature").click()
time.sleep(2)
#inserisci habitat
driver.find_element_by_link_text("Amministrazione").click()
time.sleep(3)
driver.find_element_by_link_text("Inserisci Habitat").click()
time.sleep(3)
driver.find_element_by_name("NomeHabitat").send_keys("Nuovo Habitat")
driver.find_element_by_name("Descrizione").send_keys("Questa è la descrizione")
time.sleep(4)
driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()
time.sleep(2)

driver.find_element_by_link_text("Nature").click()
##################################

#crea campagna fondi
driver.find_element_by_link_text("Amministrazione").click()
time.sleep(3)
driver.find_element_by_link_text("Crea campagna fondi").click()
time.sleep(3)
driver.find_element_by_name("descrizione").send_keys("Nuova Campagna Fondi")
driver.find_element_by_name("importo").send_keys("3000")
time.sleep(5)
driver.find_element_by_name("submitCampagna").click()
time.sleep(2)
driver.find_element_by_link_text("Premera qua per ritornare alla home").click()
time.sleep(3)
######################################
driver.find_element_by_link_text("Log Out").click()
time.sleep(4)
#crea utente semplice ed entra
driver.find_element_by_link_text("Crea Account").click()
driver.find_element_by_name("nome").send_keys("Utente Semplice")
driver.find_element_by_name("email").send_keys("utentesemplice@email.it")
driver.find_element_by_name("psw").send_keys("utentesemplice")
driver.find_element_by_name("annoNascita").send_keys("1997")
driver.find_element_by_name("professione").send_keys("Studente")
driver.find_element_by_xpath('/html/body/div/div/div/form/div[4]/input').send_keys("C:/xampp/htdocs/Progetto/img/1.jpg")
time.sleep(3)
driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()
time.sleep(4)

driver.find_element_by_link_text("Premere qua per ritornare alla home").click()

time.sleep(2)


#############################
############################################
#Log out e creazione utente semplice

#crea utente ed entra
driver.find_element_by_link_text("Crea Account").click()
driver.find_element_by_name("nome").send_keys("Nuovo Utente")
driver.find_element_by_name("email").send_keys("nuovaemail@email.it")
driver.find_element_by_name("psw").send_keys("password")
driver.find_element_by_name("annoNascita").send_keys("1997")
driver.find_element_by_name("professione").send_keys("Studente")
driver.find_element_by_xpath('/html/body/div/div/div/form/div[4]/input').send_keys("C:/xampp/htdocs/Progetto/img/1.jpg")
time.sleep(3)
driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()
time.sleep(3)

driver.find_element_by_link_text("Premere qua per ritornare alla home").click()

time.sleep(3)

driver.find_element_by_name("nome").send_keys("Nuovo Utente")
driver.find_element_by_name("password").send_keys("password")
time.sleep(2)
driver.find_element_by_name("login").click()
time.sleep(3)
#############################
#entra in visualizza utenti
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[4]/a').click()
time.sleep(10)

#######################################
#inserimento segnalazione 1
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[1]/a').click()

time.sleep(2)

driver.find_element_by_name("Latitudine").send_keys("99,99")
driver.find_element_by_name("Longitudine").send_keys("88,88")
driver.find_element_by_name("NomeHabitat").send_keys("Lago")
driver.find_element_by_xpath('/html/body/div/div/div/form/div/div/div[4]/input').send_keys("C:/xampp/htdocs/Progetto/img/1.jpg")

time.sleep(3)

driver.find_element_by_xpath('/html/body/div/div/div/form/div/div/div[5]/button').click()

time.sleep(2)

driver.find_element_by_link_text("Premere qua per tornare alla pagina precedente").click()

###########################
#inserimento segnalazione 2
time.sleep(2)

driver.find_element_by_name("Latitudine").send_keys("100,99")
driver.find_element_by_name("Longitudine").send_keys("34,88")
driver.find_element_by_name("NomeHabitat").send_keys("Lago")
driver.find_element_by_xpath('/html/body/div/div/div/form/div/div/div[4]/input').send_keys("C:/xampp/htdocs/Progetto/img/1.jpg")

time.sleep(3)

driver.find_element_by_xpath('/html/body/div/div/div/form/div/div/div[5]/button').click()

time.sleep(3)

driver.find_element_by_link_text("Premere qua per tornare alla pagina precedente").click()
###########################
#inserimento segnalazione 3

time.sleep(1)

driver.find_element_by_name("Latitudine").send_keys("45,99")
driver.find_element_by_name("Longitudine").send_keys("76,88")
driver.find_element_by_name("NomeHabitat").send_keys("Lago")
driver.find_element_by_xpath('/html/body/div/div/div/form/div/div/div[4]/input').send_keys("C:/xampp/htdocs/Progetto/img/1.jpg")

time.sleep(3)

driver.find_element_by_xpath('/html/body/div/div/div/form/div/div/div[5]/button').click()

time.sleep(3)

driver.find_element_by_link_text("Nature").click()
time.sleep(2)
###########################
#entra in visualizza utenti
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[4]/a').click()
time.sleep(8)

#######################
#scroll down and up
driver.execute_script("window.scrollTo(0,document.body.scrollHeight)")

time.sleep(2)

###################################à

#inserisci classificazione
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[2]/a').click()
time.sleep(2)
driver.find_element_by_name("CodiceSegnalazione").send_keys("1")
driver.find_element_by_name("NomeLatino").send_keys("Chionomys nivalis")
driver.find_element_by_name("Commento").send_keys("Questo è un commento! ")
time.sleep(6)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/div[4]/button').click()
time.sleep(4)
driver.find_element_by_link_text("Nature").click()
time.sleep(2)

########################################à
#log out da utente premium
driver.find_element_by_link_text("Log Out").click()
time.sleep(2)

#entra con premium 1

driver.find_element_by_name("nome").send_keys("Premium1")
driver.find_element_by_name("password").send_keys("Premium1")
time.sleep(3)
driver.find_element_by_name("login").click()
time.sleep(2)

#fai classificazione
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[2]/a').click()
time.sleep(3)
driver.find_element_by_name("CodiceSegnalazione").send_keys("1")
driver.find_element_by_name("NomeLatino").send_keys("Hystrix cristata")
driver.find_element_by_name("Commento").send_keys("Questo è un commento! ")
time.sleep(4)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/div[4]/button').click()
time.sleep(3)
driver.find_element_by_link_text("Nature").click()
time.sleep(2)
##################################################
########################################à
#log out da utente premium
driver.find_element_by_link_text("Log Out").click()
time.sleep(3)

#entra con premium 2

driver.find_element_by_name("nome").send_keys("Premium2")
driver.find_element_by_name("password").send_keys("Premium2")
time.sleep(3)
driver.find_element_by_name("login").click()
time.sleep(2)

#fai classificazione
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[2]/a').click()
time.sleep(3)
driver.find_element_by_name("CodiceSegnalazione").send_keys("1")
driver.find_element_by_name("NomeLatino").send_keys("Chionomys nivalis")
driver.find_element_by_name("Commento").send_keys("Questo è un commento! ")
time.sleep(3)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/div[4]/button').click()
time.sleep(2)
driver.find_element_by_link_text("Nature").click()
time.sleep(2)
##################################################
########################################à
#log out da utente premium
driver.find_element_by_link_text("Log Out").click()
time.sleep(3)

#entra con premium 3

driver.find_element_by_name("nome").send_keys("Premium3")
driver.find_element_by_name("password").send_keys("Premium3")
time.sleep(3)
driver.find_element_by_name("login").click()
time.sleep(3)

#fai classificazione
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[2]/a').click()
time.sleep(3)
driver.find_element_by_name("CodiceSegnalazione").send_keys("1")
driver.find_element_by_name("NomeLatino").send_keys("Hystrix cristata")
driver.find_element_by_name("Commento").send_keys("Questo è un commento! ")
time.sleep(3)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/div[4]/button').click()
time.sleep(2)
driver.find_element_by_link_text("Nature").click()
time.sleep(2)
##################################################

#log out da utente premium
driver.find_element_by_link_text("Log Out").click()
time.sleep(2)

#entra con premium 4

driver.find_element_by_name("nome").send_keys("Premium4")
driver.find_element_by_name("password").send_keys("Premium4")
time.sleep(3)
driver.find_element_by_name("login").click()
time.sleep(2)

#fai classificazione
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[2]/a').click()
time.sleep(2)
driver.find_element_by_name("CodiceSegnalazione").send_keys("1")
driver.find_element_by_name("NomeLatino").send_keys("Chionomys nivalis")
driver.find_element_by_name("Commento").send_keys("Questo è un commento! ")
time.sleep(3)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/div[4]/button').click()
time.sleep(3)
driver.find_element_by_link_text("Nature").click()
time.sleep(2)
################################################
#entra in visualizza utenti
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[4]/a').click()
time.sleep(30)

driver.execute_script("window.scrollTo(0,document.body.scrollHeight)")

time.sleep(5)



###############################
#effettua donazione
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[3]/a').click()
time.sleep(4)
driver.find_element_by_name("codiceCampagnaDonazione").send_keys("1")
driver.find_element_by_name("importoDonazione").send_keys("300")
driver.find_element_by_name("campoNote").send_keys("Questo è ciò che scrivo nel campo note")
time.sleep(6)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/button').click()
time.sleep(4)
driver.find_element_by_link_text("Nature").click()
time.sleep(2)
#####################################################

#modifica profilo utente
driver.find_element_by_xpath('//*[@id="navbarSupportedContent"]/ul/li[5]/a').click()
time.sleep(4)
driver.find_element_by_name("Email").clear()
driver.find_element_by_name("Email").send_keys("altraemail@altraemail.it")
driver.find_element_by_name("AnnoNascita").clear()
driver.find_element_by_name("AnnoNascita").send_keys("2000")
driver.find_element_by_xpath('/html/body/div/div/div/form/div/div[5]/input').send_keys("C:/xampp/htdocs/Progetto/img/1.jpg")
time.sleep(18)
driver.find_element_by_xpath('/html/body/div/div/div/form/div/button').click()
time.sleep(4)

##############################################
#invio di un messaggio
driver.find_element_by_link_text("Messaggio").click()
time.sleep(2)
driver.find_element_by_link_text("Invia messaggio").click()
time.sleep(2)
driver.find_element_by_name("titolo").send_keys("Titolo del Messaggio")
driver.find_element_by_name("testo").send_keys("Questo invece è il testo del Messaggio")
driver.find_element_by_name("destinatario").send_keys("Premium1")
time.sleep(8)
driver.find_element_by_name("submit").click()
time.sleep(6)

####################################
#controlla il messaggio inviato
driver.find_element_by_link_text("Messaggio").click()
time.sleep(4)
driver.find_element_by_link_text("Messaggi inviati").click()
time.sleep(5)

#############################################à
#crea escursione
driver.find_element_by_link_text("Escursione").click()
time.sleep(3)
driver.find_element_by_link_text("Crea una nuova escursione").click()
time.sleep(3)
driver.find_element_by_name("titoloEscursione").send_keys("Escursione di marzo")
driver.find_element_by_name("data").send_keys("22051997")
driver.find_element_by_name("orarioPartenza").send_keys("1000")
driver.find_element_by_name("orarioRitorno").send_keys("2030")
driver.find_element_by_name("tragitto").send_keys("Questo sarà il tragitto")
driver.find_element_by_name("descrizione").send_keys("La Descrizione")
driver.find_element_by_name("nPartecipanti").send_keys("10")
time.sleep(8)
driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()
time.sleep(10)
#############################################

#STATISTICHE
driver.find_element_by_link_text("Statistiche").click()
time.sleep(4)
driver.find_element_by_link_text("Classifica degli utenti premium").click()
time.sleep(8)
driver.find_element_by_link_text("Statistiche").click()
time.sleep(3)
driver.find_element_by_link_text("Classifica delle specie").click()
time.sleep(6)
driver.find_element_by_link_text("Statistiche").click()
time.sleep(3)
driver.find_element_by_link_text("Classifica degli utenti più attivi").click()
time.sleep(6)
driver.find_element_by_link_text("Nature").click()
time.sleep(3)
###################################################
#log out
driver.find_element_by_link_text("Log Out").click()
time.sleep(3)
################################################
#login con premium 1
driver.find_element_by_name("nome").send_keys("Premium1")
driver.find_element_by_name("password").send_keys("Premium1")
time.sleep(5)
driver.find_element_by_name("login").click()
time.sleep(2)

###############################
#controlla messaggi in arrivo
driver.find_element_by_link_text("Messaggio").click()
time.sleep(3)
driver.find_element_by_link_text("Messaggi in arrivo").click()
time.sleep(6)

####################################################
#iscrizione a quella escursione
driver.find_element_by_link_text("Escursione").click()
time.sleep(3)
driver.find_element_by_link_text("Iscriviti a una escursione").click()
time.sleep(3)
driver.find_element_by_name("codiceEscursione").send_keys("1")
time.sleep(4)
driver.find_element_by_name("subDonazione").click()
time.sleep(2)


##############################################

driver.find_element_by_link_text("Log Out").click()

#logga come admin per correggere una segnalazione
time.sleep(4)
driver.find_element_by_name("nome").send_keys("admin")
driver.find_element_by_name("password").send_keys("admin")
driver.find_element_by_name("login").click()
time.sleep(5)

#correggi una classificazione
driver.find_element_by_link_text("Amministrazione").click()
time.sleep(3)
driver.find_element_by_link_text("Correggi Classificazione").click()
time.sleep(3)
driver.find_element_by_name("codiceClassificazione").send_keys("1")
time.sleep(3)
driver.find_element_by_xpath('/html/body/div/div/div[2]/form/button').click()
time.sleep(3)
driver.find_element_by_name("commento").send_keys("altro commento")
time.sleep(4)
driver.find_element_by_xpath('/html/body/div/div/div/form/button').click()
time.sleep(3)

driver.find_element_by_link_text("Nature").click()
time.sleep(2)
