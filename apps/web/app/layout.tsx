import type { Metadata } from 'next';
import type { ReactNode } from 'react';

export const metadata: Metadata = {
  title: 'RoamFit',
  description: 'Train Anywhere in the Philippines with RoamFit.',
};

type RootLayoutProps = {
  children: ReactNode;
};

export default function RootLayout({ children }: RootLayoutProps) {
  return (
    <html lang="en-PH">
      <body>{children}</body>
    </html>
  );
}
