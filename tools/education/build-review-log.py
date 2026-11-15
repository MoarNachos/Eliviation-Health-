import json,pathlib
root=pathlib.Path(__file__).resolve().parents[2]
d=json.loads((root/'elivation/content/ingredients.json').read_text())
p=root/'elivation/TODO.md';s=p.read_text().split('\n## Education page claims')[0]
s+='\n## Education page claims\n\nEvery entry below is **TODO(client): medical director review**. Source links are in `content/ingredients.json`. No reviewer or lastReviewed date is asserted until approval.\n\n'
for slug,e in d.items():
 s+='### '+e['name']+'\n\n'
 claims=[('card',e['card']),('short',e['short'])]+[('body-'+str(i+1),v) for i,v in enumerate(e['body'])]+[('why',e['why']),('safety',e['safety'])]+[('faq-'+str(i+1),f['q']+' '+f['a']) for i,f in enumerate(e['faq'])]
 for key,text in claims:s+='- **TODO(client) '+slug+'-'+key+'**: '+text+'\n'
 s+='\n'
s+='### Shared approvals and formula gaps\n\n- TODO(client): medical director name, credentials, actual review date and approval for all 12 pages. Reviewer fields are null until then.\n- TODO(client): complete formulas, amounts, routes and availability for every drip. Published-menu matches only: Max Defense → vitamin C, magnesium; NAD+ 250mg / 500mg → NAD+; The Elivation → NAD+, glutathione.\n- TODO(client): ingredient matches for Amino Blend, Biotin, Lipo-C/MIC, Taurine, B12, B-Complex, Vitamin D and Zinc. Confirm whether Vitamin D and Lipo-C/MIC are IV ingredients or separate injections.\n- TODO(client): prices/durations and NAD+ additional-time charges, sourced from inc/treatments.php.\n- TODO(client): screening, precautions, required tests and clinical protocols.\n- TODO(client): booking provider support for the drip parameter; confirm the selection on the external booking site.\n- TODO(client): goal tags describe browsing interests, not promised effects.\n'
p.write_text(s)
print('Claim ledger generated for',len(d),'ingredients')
