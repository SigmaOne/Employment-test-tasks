#! /usr/bin/env ruby

require 'tiny_grabber'
require './make_tar'

def getSearchActLinksWithStartDate(startDate)
  today = Time.now.strftime("%d.%m.%Y")

  [
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=5&case_type=0&new=5&G2_PARTS__NAMESS=&g2_case__CASE_NUMBERSS=&delo_table=g2_case&g2_case__ENTRY_DATE1D=&g2_case__ENTRY_DATE2D=&G2_CASE__JUDGE=&g2_case__RESULT_DATE1D=&g2_case__RESULT_DATE2D=&G2_CASE__RESULT=&G2_CASE__COURT_I=&G2_EVENT__EVENT_DATEDD=&G2_EVENT__EVENT_NAME=&G2_PARTS__PARTS_TYPE=&G2_DOCUMENT__PUBL_DATE1D=#{startDate}&G2_DOCUMENT__PUBL_DATE2D=#{today}&G2_DOCUMENT__VALIDITY_DATE1D=&G2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=1540005&case_type=0&new=0&G1_PARTS__NAMESS=&g1_case__CASE_NUMBERSS=&delo_table=g1_case&g1_case__ENTRY_DATE1D=&g1_case__ENTRY_DATE2D=&g1_case__ORIGIN_DATE1D=&g1_case__ORIGIN_DATE2D=&G1_CASE__JUDGE=&g1_case__RESULT_DATE1D=&g1_case__RESULT_DATE2D=&G1_CASE__RESULT=&g1_case__VALIDITY_DATE1D=&g1_case__VALIDITY_DATE2D=&G1_EVENT__EVENT_NAME=&G1_EVENT__EVENT_DATEDD=&G1_PARTS__PARTS_TYPE=&ORDERS__NUMBERSS=&G1_DOCUMENT__PUBL_DATE1D=#{startDate}&G1_DOCUMENT__PUBL_DATE2D=&G1_CASE__VALIDITY_DATE1D=&G1_CASE__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=4&case_type=0&new=4&U2_DEFENDANT__NAMESS=&u2_case__CASE_NUMBERSS=&delo_table=u2_case&U2_CASE__COURT_I=&u2_case__ENTRY_DATE1D=&u2_case__ENTRY_DATE2D=&U2_CASE__CASE_TYPE=&U2_CASE__JUDGE=&u2_case__RESULT_DATE1D=&u2_case__RESULT_DATE2D=&U2_CASE__RESULT=&U2_EVENT__EVENT_DATEDD=&U2_DEFENDANT__LAW_ARTICLESS=&U2_DEFENDANT__RESULT=&U2_DOCUMENT__PUBL_DATE1D=#{startDate}&U2_DOCUMENT__PUBL_DATE2D=#{today}&U2_DOCUMENT__VALIDITY_DATE1D=&U2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=5&case_type=0&new=0&G2_PARTS__NAMESS=&g2_case__CASE_NUMBERSS=&delo_table=g2_case&g2_case__ENTRY_DATE1D=&g2_case__ENTRY_DATE2D=&G2_CASE__JUDGE=&g2_case__RESULT_DATE1D=&g2_case__RESULT_DATE2D=&G2_CASE__RESULT=&G2_CASE__COURT_I=&G2_EVENT__EVENT_DATEDD=&G2_EVENT__EVENT_NAME=&G2_PARTS__PARTS_TYPE=&G2_DOCUMENT__PUBL_DATE1D=#{startDate}&G2_DOCUMENT__PUBL_DATE2D=#{today}&G2_DOCUMENT__VALIDITY_DATE1D=&G2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=5&case_type=0&new=5&G2_PARTS__NAMESS=&g2_case__CASE_NUMBERSS=&delo_table=g2_case&g2_case__ENTRY_DATE1D=&g2_case__ENTRY_DATE2D=&G2_CASE__JUDGE=&g2_case__RESULT_DATE1D=&g2_case__RESULT_DATE2D=&G2_CASE__RESULT=&G2_CASE__COURT_I=&G2_EVENT__EVENT_DATEDD=&G2_EVENT__EVENT_NAME=&G2_PARTS__PARTS_TYPE=&G2_DOCUMENT__PUBL_DATE1D=#{startDate}&G2_DOCUMENT__PUBL_DATE2D=#{today}&G2_DOCUMENT__VALIDITY_DATE1D=&G2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23", "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=1502001&case_type=0&new=0&adm1_parts__NAMESS=&adm1_case__CASE_NUMBERSS=&delo_table=adm1_case&adm1_case__PR_NUMBERSS=&adm1_case__ENTRY_DATE1D=&adm1_case__ENTRY_DATE2D=&ADM1_CASE__JUDGE=&adm1_case__RESULT_DATE1D=&adm1_case__RESULT_DATE2D=&ADM1_CASE__RESULT=&adm1_case__VALIDITY_DATE1D=&adm1_case__VALIDITY_DATE2D=&ADM1_EVENT__EVENT_NAME=&adm1_event__EVENT_DATEDD=&adm1_parts__LAW_ARTICLESS=&adm1_document__PUBL_DATE1D=#{startDate}&adm1_document__PUBL_DATE2D=#{today}&ADM1_CASE__VALIDITY_DATE1D=&ADM1_CASE__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=5&case_type=0&new=5&G2_PARTS__NAMESS=&g2_case__CASE_NUMBERSS=&delo_table=g2_case&g2_case__ENTRY_DATE1D=&g2_case__ENTRY_DATE2D=&G2_CASE__JUDGE=&g2_case__RESULT_DATE1D=&g2_case__RESULT_DATE2D=&G2_CASE__RESULT=&G2_CASE__COURT_I=&G2_EVENT__EVENT_DATEDD=&G2_EVENT__EVENT_NAME=&G2_PARTS__PARTS_TYPE=&G2_DOCUMENT__PUBL_DATE1D=#{startDate}&G2_DOCUMENT__PUBL_DATE2D=#{today}&G2_DOCUMENT__VALIDITY_DATE1D=&G2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=4&case_type=0&new=0&U2_DEFENDANT__NAMESS=&u2_case__CASE_NUMBERSS=&delo_table=u2_case&U2_CASE__COURT_I=&u2_case__ENTRY_DATE1D=&u2_case__ENTRY_DATE2D=&U2_CASE__CASE_TYPE=&U2_CASE__JUDGE=&u2_case__RESULT_DATE1D=&u2_case__RESULT_DATE2D=&U2_CASE__RESULT=&U2_EVENT__EVENT_DATEDD=&U2_DEFENDANT__LAW_ARTICLESS=&U2_DEFENDANT__RESULT=&U2_DOCUMENT__PUBL_DATE1D=#{startDate}&U2_DOCUMENT__PUBL_DATE2D=#{today}&U2_DOCUMENT__VALIDITY_DATE1D=&U2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=5&case_type=0&new=0&G2_PARTS__NAMESS=&g2_case__CASE_NUMBERSS=&delo_table=g2_case&g2_case__ENTRY_DATE1D=&g2_case__ENTRY_DATE2D=&G2_CASE__JUDGE=&g2_case__RESULT_DATE1D=&g2_case__RESULT_DATE2D=&G2_CASE__RESULT=&G2_CASE__COURT_I=&G2_EVENT__EVENT_DATEDD=&G2_EVENT__EVENT_NAME=&G2_PARTS__PARTS_TYPE=&G2_DOCUMENT__PUBL_DATE1D=#{startDate}&G2_DOCUMENT__PUBL_DATE2D=#{today}&G2_DOCUMENT__VALIDITY_DATE1D=&G2_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=2800001&case_type=0&new=2800001&G33_PARTS__NAMESS=&g33_case__CASE_NUMBERSS=&delo_table=g33_case&g33_case__ENTRY_DATE1D=&g33_case__ENTRY_DATE2D=&G33_CASE__CASE_NUMBER_ISS=&g33_case__VERDICT_DATE_I1D=&g33_case__VERDICT_DATE_I2D=&G33_CASE__JUDGE=&G33_CASE__COURT_I=&g33_case__RESULT_DATE1D=&g33_case__RESULT_DATE2D=&G33_CASE__RESULT=&G33_CASE__WRIT_TYPE=&G33_CASE__VSRFID_NOTPOST=&G33_EVENT__EVENT_DATEDD=&G33_COMPLAINT__DECLARANT_NAMESS=&G33_COMPLAINT__ENTRY_DATE1D=&G33_COMPLAINT__ENTRY_DATE2D=&G33_COMPLAINT__ESSENCESS=&G33_COMPLAINT__RESULT_DATE1D=&G33_COMPLAINT__RESULT_DATE2D=&G33_COMPLAINT__RESULT=&G3_DOCUMENT__PUBL_DATE1D=#{startDate}&G3_DOCUMENT__PUBL_DATE2D=#{today}&G3_DOCUMENT__VALIDITY_DATE1D=&G3_DOCUMENT__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
    "https://oblsud--kln.sudrf.ru/modules.php?name=sud_delo&srv_num=1&name_op=r&delo_id=1513001&case_type=0&new=0&adm2_parts__NAMESS=&adm2_case__CASE_NUMBERSS=&delo_table=adm2_case&adm2_case__PR_NUMBERSS=&adm2_case__ENTRY_DATE1D=&adm2_case__ENTRY_DATE2D=&ADM2_CASE__JUDGE=&adm2_case__RESULT_DATE1D=&adm2_case__RESULT_DATE2D=&ADM2_CASE__RESULT=&ADM2_EVENT__EVENT_NAME=&adm2_event__EVENT_DATEDD=&adm2_parts__LAW_ARTICLESS=&adm2_document__PUBL_DATE1D=#{startDate}&adm2_document__PUBL_DATE2D=#{today}&adm2_document__VALIDITY_DATE1D=&adm2_document__VALIDITY_DATE2D=&Submit=%25CD%25E0%25E9%25F2%25E8%23",
  ]
end
def exportActTextFromUrl(url)
  ng = getNokogiriObjectByLink(url)
  act_text = ""

  ng.xpath("//div[@class='Section1']//p").each do |p|
    act_text += "#{p.text}\n"
  end

  act_text
end
def fillActByUrl(act, link)
  ng = getNokogiriObjectByLink(link)

  ng.xpath("//div[@id='cont1']//table[@id='tablcont']//tr").each_with_index do |row, index|
    next if index < 4

    name = row.xpath("./td[1]").text
    value = row.xpath("./td[2]").text
    act[name] = value
  end
end

def getNokogiriObjectByLink(url)
  tg = TinyGrabber.new

  # -----------------Initialize request setting------------------
  # Set request timeout
  read_timeout = 300
  # You can set your own UserAgent, but by default each request get random UserAgent from list of most popular
  headers = { 'Content-Type' => 'text/html; charset=utf-8' }
  # Set max time to execute request
  tg.read_timeout = read_timeout
  # Set HTTP headers
  tg.headers = headers

  # ------------------------Make request------------------------
  response = tg.get(url, headers)

  # ---------Return Nokogiri object from response HTML----------
  response.ng
end
def retrieveActsByLink(link)
  ng = getNokogiriObjectByLink(link)
  column_names = []
  acts = []

  # Fill acts
  ng.xpath("//table[@id='tablcont']//tr").each_with_index do |row, index|
    if index == 0
      columns = row.xpath("./th")

      columns.each do |column|
        column_names.push column.text
      end
    else
      columns = row.xpath("./td")
      act = {}

      column_names.each_with_index do |name, index|
        if column_names[index] == "№ дела"
          act[name] = columns[index].text.strip
          act["СсылкаНаДело"] = "https://oblsud--kln.sudrf.ru#{columns[index].xpath("./a/@href")}"
          fillActByUrl(act, act["СсылкаНаДело"])
        elsif column_names[index] == "Судебныеакты"
          act["СсылкаНаСудебныйAкт"] = "https://oblsud--kln.sudrf.ru#{columns[index].xpath("./a/@href")}"
          act[name] = exportActTextFromUrl "https://oblsud--kln.sudrf.ru#{columns[index].xpath("./a/@href")}"
        else
          act[name] = columns[index].text.strip
        end
      end

      acts.push act
    end
  end

  # Follow pagination if present
  if ng.xpath("//div[@id='content']//a[text() = '>']/@href").to_s.empty?
    acts
  else
    text = ng.xpath("//a[text() = '>']/@href").to_s[1..-1]
    acts.concat(retrieveActsByLink("https://oblsud--kln.sudrf.ru#{text}"))
  end
end
def toXMLs(acts)
  xmls = Array.new

  acts.each do |act|
    builder = Nokogiri::XML::Builder.new(encoding: 'UTF-8') do
      root {
        act {
          act.each do |key, value|
            send(key, value)
          end
        }
      }
    end
    xmls.push builder.to_xml
  end

  xmls
end

# ----------------------------- main ----------------------------- #
include Util::Tar

getSearchActLinksWithStartDate(ARGV[0]).each do |link|
  acts = retrieveActsByLink(link)

  # write to files
  Dir.mkdir 'out' unless File.exists?('out')
  Dir.mkdir 'out/fetched_acts' unless File.exists?('out/fetched_acts')
  toXMLs(acts).each_with_index do |act, index|
    File.write("./out/fetched_acts/fetchedAct\##{index}.xml", act)
  end

  # make tar
  File.write("./out/fetched_acts.tar.gz", tar("./out/fetched_acts").read)
end