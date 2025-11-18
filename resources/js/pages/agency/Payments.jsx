import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    Text,
    Select,
    VStack,
} from '@chakra-ui/react';
import { Download, Eye, CreditCard } from 'lucide-react';

const Payments = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const payments = [
        {
            id: 'PAY-001',
            date: '2025-11-15',
            description: 'Monthly Subscription - Professional Plan',
            amount: 79.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
            invoiceUrl: '#',
        },
        {
            id: 'PAY-002',
            date: '2025-10-15',
            description: 'Monthly Subscription - Professional Plan',
            amount: 79.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
            invoiceUrl: '#',
        },
        {
            id: 'PAY-003',
            date: '2025-09-15',
            description: 'Monthly Subscription - Professional Plan',
            amount: 79.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
            invoiceUrl: '#',
        },
        {
            id: 'PAY-004',
            date: '2025-08-15',
            description: 'Monthly Subscription - Professional Plan',
            amount: 79.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
            invoiceUrl: '#',
        },
        {
            id: 'PAY-005',
            date: '2025-07-15',
            description: 'Monthly Subscription - Basic Plan',
            amount: 29.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
            invoiceUrl: '#',
        },
        {
            id: 'PAY-006',
            date: '2025-06-15',
            description: 'Monthly Subscription - Basic Plan',
            amount: 29.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
            invoiceUrl: '#',
        },
        {
            id: 'PAY-007',
            date: '2025-12-15',
            description: 'Monthly Subscription - Professional Plan',
            amount: 79.00,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'pending',
            invoiceUrl: '#',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Payment History</Heading>
                <HStack spacing={3}>
                    <Select placeholder="All time" w="150px">
                        <option value="month">This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </Select>
                    <Button leftIcon={<CreditCard size={20} />} colorScheme="blue">
                        Update Payment Method
                    </Button>
                </HStack>
            </HStack>

            <VStack spacing={6} align="stretch">
                {/* Current Plan */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <HStack justify="space-between">
                        <VStack align="start" spacing={1}>
                            <Text fontSize="sm" color="gray.500">
                                Current Plan
                            </Text>
                            <Heading size="lg">Professional Plan</Heading>
                            <Text fontSize="2xl" fontWeight="bold" color="blue.600">
                                $79/month
                            </Text>
                        </VStack>
                        <VStack align="end" spacing={1}>
                            <Badge colorScheme="green" fontSize="md" px={3} py={1}>
                                Active
                            </Badge>
                            <Text fontSize="sm" color="gray.500">
                                Next billing: Dec 15, 2025
                            </Text>
                            <Button size="sm" variant="link" colorScheme="blue">
                                Change Plan
                            </Button>
                        </VStack>
                    </HStack>
                </Box>

                {/* Payment Method */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <HStack justify="space-between">
                        <VStack align="start" spacing={1}>
                            <Text fontSize="sm" color="gray.500">
                                Payment Method
                            </Text>
                            <HStack spacing={3}>
                                <CreditCard size={24} />
                                <VStack align="start" spacing={0}>
                                    <Text fontWeight="semibold">Visa ending in 4242</Text>
                                    <Text fontSize="sm" color="gray.500">
                                        Expires 12/2026
                                    </Text>
                                </VStack>
                            </HStack>
                        </VStack>
                        <Button size="sm" colorScheme="blue" variant="outline">
                            Update
                        </Button>
                    </HStack>
                </Box>

                {/* Payment History Table */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Transaction History
                    </Heading>
                    <Table variant="simple">
                        <Thead>
                            <Tr>
                                <Th>ID</Th>
                                <Th>Date</Th>
                                <Th>Description</Th>
                                <Th>Payment Method</Th>
                                <Th>Amount</Th>
                                <Th>Status</Th>
                                <Th>Actions</Th>
                            </Tr>
                        </Thead>
                        <Tbody>
                            {payments.map((payment) => (
                                <Tr key={payment.id}>
                                    <Td fontWeight="semibold" fontSize="sm">
                                        {payment.id}
                                    </Td>
                                    <Td fontSize="sm">{payment.date}</Td>
                                    <Td fontSize="sm">{payment.description}</Td>
                                    <Td>
                                        <HStack spacing={2}>
                                            <CreditCard size={16} />
                                            <Text fontSize="sm">{payment.card}</Text>
                                        </HStack>
                                    </Td>
                                    <Td fontWeight="bold" color="green.600">
                                        ${payment.amount.toFixed(2)}
                                    </Td>
                                    <Td>
                                        <Badge colorScheme={payment.status === 'paid' ? 'green' : 'yellow'}>
                                            {payment.status}
                                        </Badge>
                                    </Td>
                                    <Td>
                                        <HStack spacing={2}>
                                            <IconButton
                                                icon={<Eye size={16} />}
                                                size="sm"
                                                colorScheme="blue"
                                                variant="ghost"
                                                aria-label="View invoice"
                                            />
                                            <IconButton
                                                icon={<Download size={16} />}
                                                size="sm"
                                                colorScheme="green"
                                                variant="ghost"
                                                aria-label="Download invoice"
                                            />
                                        </HStack>
                                    </Td>
                                </Tr>
                            ))}
                        </Tbody>
                    </Table>
                </Box>
            </VStack>
        </Box>
    );
};

export default Payments;
