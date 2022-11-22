export default function MonthNames({ actualMonth }) {

    switch(actualMonth) {
        case 1: return actualMonth = 'styczeń';
        case 2: return actualMonth = 'luty';
        case 3: return actualMonth = 'marzec';
        case 4: return actualMonth = 'kwiecień';
        case 5: return actualMonth = 'maj';
        case 6: return actualMonth = 'czerwiec';
        case 7: return actualMonth = 'lipiec';
        case 8: return actualMonth = 'sierpień';
        case 9: return actualMonth = 'wrzesień';
        case 10: return actualMonth = 'październik';
        case 11: return actualMonth = 'listopad';
        case 12: return actualMonth = 'grudzień';
    }
}