import { StatusBar } from 'expo-status-bar';
import { SafeAreaView, Text, View } from 'react-native';

const flows = ['Discover', 'Map', 'Check In', 'Rewards', 'Profile'];

export default function App() {
  return (
    <SafeAreaView style={{ flex: 1, backgroundColor: '#020617' }}>
      <StatusBar style="light" />
      <View style={{ flex: 1, padding: 24, justifyContent: 'center' }}>
        <Text style={{ color: '#6ee7b7', letterSpacing: 4, textTransform: 'uppercase' }}>RoamFit</Text>
        <Text style={{ color: 'white', fontSize: 40, fontWeight: '800', marginTop: 16 }}>Train Anywhere in the Philippines.</Text>
        <Text style={{ color: '#cbd5e1', fontSize: 16, marginTop: 16 }}>
          Mobile-first member and staff workflows for credits, secure QR check-ins, rewards, and fitness consistency.
        </Text>
        <View style={{ marginTop: 24, gap: 10 }}>
          {flows.map((flow) => (
            <Text key={flow} style={{ color: 'white', backgroundColor: '#0f172a', padding: 14, borderRadius: 14 }}>{flow}</Text>
          ))}
        </View>
      </View>
    </SafeAreaView>
  );
}
