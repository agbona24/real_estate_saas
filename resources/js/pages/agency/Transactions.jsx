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
    VStack,
    Text,
    Select,
} from '@chakra-ui/react';
import { Plus, Eye, FileText, Download } from 'lucide-react';

const Transactions = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const transactions = [
        {
            id: 'TXN-001',
            property: '123 Main St, Downtown',
            buyer: 'John Smith',
            seller: 'Property Owner LLC',
            realtor: 'Sarah Johnson',
            amount: 450000,
            commission: 13500,
            date: '2025-11-15',
            closingDate: '2025-12-15',
            status: 'completed',
            type: 'sale',
        },
        {
            id: 'TXN-002',
            property: '456 Oak Ave, Suburbs',
            buyer: 'Emily Davis',
            seller: 'Metro Realty Group',
            realtor: 'Michael Chen',
            amount: 325000,
            commission: 9750,
            date: '2025-11-14',
            closingDate: '2025-12-20',
            status: 'pending',
            type: 'sale',
        },
        {
            id: 'TXN-003',
            property: '789 Pine Rd, Lakeside',
            buyer: 'Robert Wilson',
            seller: 'Lakeside Estates',
            realtor: 'Sarah Johnson',
            amount: 675000,
            commission: 20250,
            date: '2025-11-12',
            closingDate: '2025-12-10',
            status: 'in_progress',
            type: 'sale',
        },
        {
            id: 'TXN-004',
            property: '321 Elm St, City Center',
            buyer: 'Lisa Anderson',
            seller: 'City Properties Inc',
            realtor: 'David Kim',
            amount: 520000,
            commission: 15600,
            date: '2025-11-10',
            closingDate: '2025-11-28',
            status: 'completed',
            type: 'sale',
        },
        {
            id: 'TXN-005',
            property: '654 Maple Dr, East Side',
            buyer: 'Mark Thompson',
            seller: 'Eastside Developments',
            realtor: 'Jessica Martinez',
            amount: 275000,
            commission: 8250,
            date: '2025-11-08',
            closingDate: '2025-12-25',
            status: 'pending',
            type: 'sale',
        },
        {
            id: 'TXN-006',
            property: '111 River St, Waterfront',
            buyer: null,
            seller: 'Premium Homes',
            realtor: 'Michael Chen',
            amount: 2500,
            commission: 0,
            date: '2025-11-01',
            closingDate: null,
            status: 'completed',
            type: 'rental',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Transactions</Heading>
                <HStack spacing={3}>
                    <Select placeholder="All types" w="150px">
                        <option value="sale">Sale</option>
                        <option value="rental">Rental</option>
                        <option value="lease">Lease</option>
                    </Select>
                    <Select placeholder="All status" w="150px">
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                    </Select>
                    <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                        New Transaction
                    </Button>
                </HStack>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>ID</Th>
                            <Th>Property</Th>
                            <Th>Parties</Th>
                            <Th>Realtor</Th>
                            <Th>Amount</Th>
                            <Th>Commission</Th>
                            <Th>Date</Th>
                            <Th>Closing Date</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {transactions.map((transaction) => (
                            <Tr key={transaction.id}>
                                <Td fontWeight="semibold">{transaction.id}</Td>
                                <Td>
                                    <VStack align="start" spacing={0}>
                                        <Text fontSize="sm" fontWeight="semibold">
                                            {transaction.property}
                                        </Text>
                                        <Badge size="sm" colorScheme="purple">
                                            {transaction.type}
                                        </Badge>
                                    </VStack>
                                </Td>
                                <Td>
                                    <VStack align="start" spacing={0} fontSize="sm">
                                        <Text>
                                            <Text as="span" fontWeight="semibold">
                                                Buyer:{' '}
                                            </Text>
                                            {transaction.buyer || 'N/A'}
                                        </Text>
                                        <Text color="gray.500">
                                            <Text as="span" fontWeight="semibold">
                                                Seller:{' '}
                                            </Text>
                                            {transaction.seller}
                                        </Text>
                                    </VStack>
                                </Td>
                                <Td fontSize="sm">{transaction.realtor}</Td>
                                <Td fontWeight="bold" color="blue.600">
                                    ${transaction.amount.toLocaleString()}
                                </Td>
                                <Td fontWeight="bold" color="green.600">
                                    ${transaction.commission.toLocaleString()}
                                </Td>
                                <Td fontSize="sm">{transaction.date}</Td>
                                <Td fontSize="sm">{transaction.closingDate || 'N/A'}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            transaction.status === 'completed'
                                                ? 'green'
                                                : transaction.status === 'pending'
                                                ? 'yellow'
                                                : 'blue'
                                        }
                                    >
                                        {transaction.status.replace('_', ' ')}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View transaction"
                                        />
                                        <IconButton
                                            icon={<FileText size={16} />}
                                            size="sm"
                                            colorScheme="purple"
                                            variant="ghost"
                                            aria-label="View documents"
                                        />
                                        <IconButton
                                            icon={<Download size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Download receipt"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Transactions;
